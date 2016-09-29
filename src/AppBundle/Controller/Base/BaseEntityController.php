<?php

namespace AppBundle\Controller\Base;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Utils\ClassUtils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\AdvertFilter;
use AppBundle\Entity\Advert;

abstract class BaseEntityController extends Controller
{
	/**
	 *
	 * @param Request $request
	 * @param integer $page current page number
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function indexActionInternal(Request $request, $page)
	{
		$params = $this->getIndexParams($request, $page);
		return $this->render($this->getIndexView(), $params);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id current entry ID
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function showActionInternal(Request $request, $id)
	{
		$params = $this->getShowParams($request, $id);
		return $this->render($this->getShowView(), $params);
	}
	
	protected function redirectToReferer(Request $request) {
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
    /**
     * 
     * @param Request $request
     * @param integer $page current page number
     * @return mixed[]
     */
    protected function getIndexParams(Request $request, $page)
    {
    	$params = $this->getParams($request);
    	
    	$routeParams =  $this->getIndexRouteParams($request, $page);
    	$this->registerRequest($request, $this->getIndexRoute(), $routeParams);
    	
    	$entryFilter = $this->getEntityFilter($request);
    	$params['entryFilter'] = $entryFilter;
    	
    	$repository = $this->getEntityRepository();
    	$query = $repository->querySelected($entryFilter);
    	 
    	$paginator = $this->get('knp_paginator');
    	$entries = $paginator->paginate($query, $page, $this->getPageEntries($request));
    	$params['entries'] = $entries;
    	
    	$params = array_merge($params, $this->getRoutingParams($request));
    	return $params;
    }
    
    protected function getIndexRouteParams(Request $request, $page) {
    	$routeParams = $this->getRouteParams($request);
    	$routeParams['page'] = $page;
    	
    	return $routeParams;
    }
    
    /**
     * 
     * @param Request $request
     * @param integer $id current entry ID
     * @return mixed[]
     */
    protected function getShowParams(Request $request, $id)
    {
    	$params = $this->getParams($request);
    	
    	$routeParams = $this->getShowRouteParams($request, $id);
    	$this->registerRequest($request, $this->getShowRoute(), $routeParams);
    	
    	$entry = $this->getEntry($id);
    	$params['entry'] = $entry;
    	
    	$params = array_merge($params, $this->getRoutingParams($request));
    	return $params;
    }
    
    protected function getShowRouteParams(Request $request, $id) {
    	$routeParams = $this->getRouteParams($request);
    	$routeParams['id'] = $id;
    	 
    	return $routeParams;
    }
    
    //TODO can make another class for registering requests??
    /**
     * @param Request $request
     */
    protected function getRouteParams(Request $request) {
    	$entryFilter = $this->getRequestEntityFilter($request);
    	$routeParams = $entryFilter->getValues();
    	 
    	return $routeParams;
    }
    
    
    protected function getParams(Request $request) {
    	return array();
    }
    
    protected function getRoutingParams(Request $request) {
    	return $request->getSession()->get('last_route', array('route' => $this->getIndexView(), 'routeParams' => array()));
    }
    
    protected function getAdvertParams(Request $request)
    {
    	$params = array();
    	 
    	$userRepository = $this->getDoctrine()->getRepository(User::class);
    	$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
    	 
    	$advertFilter = new AdvertFilter($userRepository, $categoryRepository);
    	$advertFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$advertFilter->setActive(BaseEntityFilter::TRUE_VALUES);
    	 
    	$category = $this->getParamById($request, Category::class, null);
    	if ($category) {
    		if ($category->getPreleaf()) {
    			$advertFilter->setCategories([$category]);
    		} else if ($category->getParent()) {
    			$advertFilter->setCategories([$category->getParent()]);
    		}
    	}
    	 
    	$advertFilter->setLocations([Advert::TOP_LOCATION]);
    
    	$topAds = $this->getParamList(Advert::class, $advertFilter);
    	shuffle($topAds);
    	$topAds = array_slice($topAds, 0, 3);
    	$params['topAds'] = $topAds;
    	 
    	$advertFilter->setLocations([Advert::SIDE_LOCATION]);
    	 
    	$sideAds = $this->getParamList(Advert::class, $advertFilter);
    	shuffle($sideAds);
    	$sideAds = array_slice($sideAds, 0, 3);
    	$params['sideAds'] = $sideAds;
    	 
    	 
    	$em = $this->getDoctrine()->getManager();
    	 
    	foreach($topAds as $ad) {
    		$ad->setShowCount($ad->getShowCount()+1);
    		$em->persist($ad);
    	}
    	$em->flush();
    	 
    	foreach($sideAds as $ad) {
    		$ad->setShowCount($ad->getShowCount()+1);
    		$em->persist($ad);
    	}
    	$em->flush();
    	 
    	return $params;
    }
    
    protected function registerRequest(Request $request, $route, $routeParams) {
    	$session = $request->getSession();
    	
    	$currRoute = $session->get('curr_route', null);
    	$newRoute = array('route' => $route, 'routeParams' => $routeParams);
    	
    	if($currRoute != null && $this->isDuplicate($currRoute, $newRoute)) {
    		return;
    	}
    	
    	if($currRoute != null) {
    		$session->set('last_route', $currRoute);
    	}
    	
    	$session->set('curr_route', !$this->isRestricted($newRoute) ? $newRoute : null);
    }
    
    protected function isDuplicate($currRoute, $newRoute) {
    	if($currRoute['route'] != $newRoute['route']) {
    		return false;
    	}
    
    	$currRouteParams = $currRoute['routeParams'];
    	$newRouteParams = $newRoute['routeParams'];
    
    	$count = count($currRouteParams);
    
    	if($count != count($newRouteParams)) {
    		return  false;
    	}
    
    	foreach(array_keys($currRouteParams) as $key) {
    		if(!array_key_exists($key, $newRouteParams)) {
    			return false;
    		}
    			
    		if($currRouteParams[$key] != $newRouteParams[$key]) {
    			return false;
    		}
    	}
    		
    	return true;
    }
    
    protected function isRestricted($newRoute) {
    	if(strpos($newRoute['route'], '_new') !== false) {
    		return true;
    	}
    	
    	if(strpos($newRoute['route'], '_copy') !== false) {
    		return true;
    	}
    	
    	if(strpos($newRoute['route'], '_delete') !== false) {
    		return true;
    	}
    
    	return false;
    }
    
    /**
     * 
     * @param Request $request
     * @param class $paramClass
     * @param string $template default name
     * @return object
     */
    protected function getParamByName(Request $request, $paramClass, $template)
    {
    	$repository = $this->getDoctrine()->getRepository($paramClass);
    	$paramName = ClassUtils::getClassName($paramClass);
    	$name = $request->get($paramName, $template);
    	return $name ? $repository->findOneBy(['name' => $name]) : null;
    }
    
    /**
     *
     * @param Request $request
     * @param class $paramClass
     * @param integer $template default ID
     * @return object
     */
    protected function getParamById($request, $paramClass, $template)
    {
    	$repository = $this->getDoctrine()->getRepository($paramClass);
    	$paramName = ClassUtils::getClassName($paramClass);
    	$id = $request->get($paramName, $template);
    	return $id ? $repository->find($id) : null;
    }
    
    /**
     * 
     * @param unknown $request
     * @param unknown $paramClass
     * @param unknown $name
     * @param unknown $template
     */
    protected function getParamByNameId($request, $paramClass, $name, $template)
    {
    	$repository = $this->getDoctrine()->getRepository($paramClass);
    	$id = $request->get($name, $template);
    	return $id ? $repository->find($id) : null;
    }
    
    /**
     * 
     * @param class $paramClass
     * @param object $filter
     * @return object[]
     */
    protected function getParamList($paramClass, $filter)
    {
    	$repository = $this->getDoctrine()->getRepository($paramClass);
    	return $repository->findSelected($filter);
    }
    
    /**
     * 
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getEntityRepository()
    {
    	return $this->getDoctrine()->getRepository($this->getEntityType());
    }
    
    /**
     * 
     */
    protected function getEntityName()
    {
    	return ClassUtils::getClassName($this->getEntityType());
    }
    
    /**
     * @return class
     */
    protected abstract function getEntityType();
    
    /**
     * 
     * @param Request $request
     * @return object
     */
	protected function getEntityFilter(Request $request)
	{
		return $this->getRequestEntityFilter($request);
	}
	
	protected function getRequestEntityFilter(Request $request)
	{
		$filter = $this->createNewFilter();
		$filter->initValues($request);
			
		return $filter;
	}
    
	protected function createNewFilter() {
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		return new BaseEntityFilter($userRepository);
	}
	
	protected function getEntry($id) {
		$repository = $this->getDoctrine()->getRepository($this->getEntityType());
		$entry = $repository->find($id);
	
		return $entry;
	}
	
    /**
     * 
     * @param Request $request
     * @return integer
     */
    protected function getPageEntries(Request $request) 
    {
    	return 20;
    }
    
    protected function getIndexView()
    {
    	return $this->getBaseName() . '/' . $this->getEntityName() . '/index.html.twig';
    }
    
    protected function getShowView()
    {
    	return $this->getBaseName() . '/' . $this->getEntityName() . '/show.html.twig';
    }
    
    protected function getIndexRoute()
    {
    	return $this->getBaseName() . '_' . $this->getEntityName();
    }
    
    protected function getShowRoute()
    {
    	return $this->getIndexRoute() . '_show';
    }
    
    /**
     * @return string base part of the routes' name
     */
    protected abstract function getBaseName();
}
