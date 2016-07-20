<?php

namespace AppBundle\Controller\Base;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Utils\ClassUtils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
	
	protected function redirectToReferer() {
		$referer = $this->getRequest()->headers->get('referer');
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
    	$params = $this->getRouteParams($request);
    	
    	$entryFilter = $this->getEntityFilter($request);
    	$params['entryFilter'] = $entryFilter;
    	
    	$params['routeParams'] = array_merge($params['routeParams'], $entryFilter->getValues());
    	
    	$repository = $this->getEntityRepository();
    	$query = $repository->querySelected($entryFilter);
    	 
    	$paginator = $this->get('knp_paginator');
    	$entries = $paginator->paginate($query, $page, $this->getPageEntries($request));
    	
    	$params['entries'] = $entries;
    	
    	return $params;
    }
    
    /**
     * 
     * @param Request $request
     * @param integer $id current entry ID
     * @return mixed[]
     */
    protected function getShowParams(Request $request, $id)
    {
    	$params = $this->getRouteParams($request);
    	
    	$repository = $this->getEntityRepository();
    	$entry = $repository->find($id);
    	
    	$params['entry'] = $entry;
    	
    	return $params;
    }
    
    protected function getRouteParams(Request $request) {
    	$params = array();
    	
    	$params['route'] = $request->get('route', $this->getIndexRoute());
    	$params['routeParams'] = $request->get('routeParams', []);
    	
    	return $params;
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
		$filter = new BaseEntityFilter();
		$filter->initValues($request);
		$filter->setPublished(true);
		 
		return $filter;
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
