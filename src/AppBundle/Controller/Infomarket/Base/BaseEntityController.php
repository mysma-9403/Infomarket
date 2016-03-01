<?php

namespace AppBundle\Controller\Infomarket\Base;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\BranchFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Utils\ClassUtils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseEntityController extends Controller
{
	/**
	 *
	 * @param Request $request
	 * @param integer $page
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function indexActionInternal(Request $request, $page)
	{
		$params = $this->initIndexParams($request, $page);
		 
		$name = $this->getEntityName();
		return $this->render('infomarket/' . $name . '/index.html.twig', $params);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function showActionInternal(Request $request, $id)
	{
		$params = $this->initShowParams($request);
	
		$name = $this->getEntityName();
		return $this->render('infomarket/' . $name . '/show.html.twig', $params);
	}
	
    /**
     * 
     * @param Request $request
     */
    protected function initIndexParams(Request $request, $page)
    {
    	$params = $this->initParams($request);
    	
    	$filter = $this->getEntityFilter($request);
    	
    	$repository = $this->getEntityRepository();
    	$query = $repository->querySelected($filter);
    	 
    	$paginator = $this->get('knp_paginator');
    	$entries = $paginator->paginate($query, $page, $this->getPageEntries($request));
    	
    	$params['entries'] = $entries;
    	
    	return $params;
    }
    
    /**
     * 
     * @param Request $request
     */
    protected function initShowParams(Request $request, $id)
    {
    	$params = $this->initParams($request);
    	
    	$repository = $this->getEntityRepository();
    	$entry = $repository->find($id);
    	
    	$params['entry'] = $entry;
    	
    	return $params;
    }
    
    /**
     * 
     * @param Request $request
     */
    protected function initParams(Request $request)
    {
    	$params = [];
    	
    	// params
    	$branch = $this->getParam($request, Branch::class);
    	$category = $this->getParam($request, Category::class);
    	$articleCategory = $this->getParam($request, ArticleCategory::class);
    	
    	$params['branch'] = $branch;
    	$params['category'] = $category;
    	$params['article_category'] = $articleCategory;
    	
    	// param lists
    	$branchFilter = new BranchFilter();
    	$branches = $this->getParamList(Branch::class, $branchFilter);
    	
    	$categoryFilter = new CategoryFilter();
    	$categoryFilter->setBranch($branch);
    	$categories = $this->getParamList(Category::class, $categoryFilter);
    	
    	$articleCategoryFilter = new SimpleEntityFilter();
    	//$articleCategoryFilter->setBranch($branch);
    	$articleCategories = $this->getParamList(ArticleCategory::class, $articleCategoryFilter);
    	
    	$params['branches'] = $branches;
    	$params['categories'] = $categories;
    	$params['article_categories'] = $articleCategories;
    	 
    	return $params;
    }
    
    /**
     * 
     * @param unknown $request
     * @param unknown $paramClass
     */
    protected function getParam($request, $paramClass)
    {
    	$repository = $this->getDoctrine()->getRepository($paramClass);
    	$paramName = ClassUtils::getClassName($paramClass);
    	$name = $request->get($paramName, null);
    	return $repository->findOneBy(['name' => $name]);
    }
    
    /**
     * 
     * @param unknown $paramClass
     * @param unknown $filter
     */
    protected function getParamList($paramClass, $filter)
    {
    	$repository = $this->getDoctrine()->getRepository($paramClass);
    	return $repository->findSelected($filter);
    }
    
    /**
     * 
     */
    protected function getEntityRepository()
    {
    	return $this->getDoctrine()->getRepository($this->getEntityType());
    }
    
    protected function getEntityName()
    {
    	return ClassUtils::getClassName($this->getEntityType());
    }
    
    /**
     * 
     */
    protected abstract function getEntityType();
    
    /**
     *
     */
    protected abstract function getEntityFilter(Request $request);
    
    /**
     * 
     * @param Request $request
     * @return number
     */
    protected function getPageEntries(Request $request) 
    {
    	return 6;
    }
}
