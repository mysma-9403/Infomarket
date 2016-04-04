<?php

namespace AppBundle\Controller\Base;

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
	
    /**
     * 
     * @param Request $request
     * @param integer $page current page number
     * @return mixed[]
     */
    protected function getIndexParams(Request $request, $page)
    {
    	$params = $this->getParams($request);
    	
    	$entryFilter = $this->getEntityFilter($request);
    	$params['entryFilter'] = $entryFilter;
    	
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
    	$params = $this->getParams($request);
    	
    	$repository = $this->getEntityRepository();
    	$entry = $repository->find($id);
    	
    	$params['entry'] = $entry;
    	
    	return $params;
    }
    
    /**
     * 
     * @param Request $request
     * @return mixed[]
     */
    protected function getParams(Request $request)
    {
    	$params = [];
    	
    	$params['routingParams'] = $this->getRoutingParams($request);
    
    	return $params;
    }
    
    /**
     * 
     * @param Request $request
     * @return mixed[]
     */
    protected function getRoutingParams(Request $request)
    {
    	$params = [];
    	 
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
     * @param class $paramClass
     * @param object $filter
     * @return object[]
     */
    protected function getParamList($paramClass, $filter) //TODO filter moze miec paramClass
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
    protected abstract function getEntityFilter(Request $request);
    
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
