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
		
		return $this->render($this->getIndexView(), $params);
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
		$params = $this->initShowParams($request, $id);
	
		return $this->render($this->getShowView(), $params);
	}
	
    /**
     * 
     * @param Request $request
     */
    protected function initIndexParams(Request $request, $page)
    {
    	$params = $this->initParams($request);
    	
    	$entryFilter = $this->getEntityFilter($request);
    	
    	$repository = $this->getEntityRepository();
    	$query = $repository->querySelected($entryFilter);
    	 
    	$paginator = $this->get('knp_paginator');
    	$entries = $paginator->paginate($query, $page, $this->getPageEntries($request));
    	
    	$params['entries'] = $entries;
    	$params['entryFilter'] = $entryFilter;
    	
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
    	
    	$branchFilter = new BranchFilter();
    	$branchFilter->setPublished(true);
    	$branches = $this->getParamList(Branch::class, $branchFilter);
    	
    	$branch = $this->initBranch($request, $branches);
    	
    	$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
    	$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
    	
    	$categoryFilter = new CategoryFilter($branchRepository, $categoryRepository);
    	
    	$categoryFilter->initValues($request); //TODO make it better :P
    	
    	$categoryFilter->setPublished(true);
    	if($branch) $categoryFilter->setBranches([$branch]);
    	$categoryFilter->setRoot($this->showRootCategories());
    	$categoryFilter->setPreleaf($this->showPreleafCategories());
    	
    	$categories = $this->getParamList(Category::class, $categoryFilter);
    	
    	$category = $this->getParamById($request, Category::class, null);
    	
    	$pathCategories = array();
    	
    	if($category) {
    		if(false) {//TODO $category->getBranchCategoryAssignment()->getBranch()->getId() != $branch->getId()) {
    			$category = null;
    		} else {
    			$pathCategories = $this->addWithParent($pathCategories, $category);
    		}
    	}
    	
    	$articleCategoryFilter = new SimpleEntityFilter();
    	//$articleCategoryFilter->setBranch($branch);
    	$articleCategories = $this->getParamList(ArticleCategory::class, $articleCategoryFilter);
    	
    	$articleCategory = $this->getParam($request, ArticleCategory::class, $articleCategories[0]->getName());
    	
    	
    	
    	$params['branch'] = $branch;
    	$params['category'] = $category;
    	$params['article_category'] = $articleCategory;
    	
    	$params['branches'] = $branches;
    	$params['categories'] = $categories;
    	$params['article_categories'] = $articleCategories;
    	
    	$params['pathCategories'] = $pathCategories;
    	
    	$params['categoryFilter'] = $categoryFilter;
    	 
    	return $params;
    }
    
    protected function initBranch(Request $request, $branches)
    {
    	return $this->getParam($request, Branch::class, $branches[0]->getName());
    }
    
    protected function showRootCategories()
    {
    	return true;
    }
    
    protected function showPreleafCategories()
    {
    	return false;
    }    
    
    protected function addWithParent($list, $entry) {
    	array_unshift($list, $entry);
    	
    	if($entry->getParent() != null) {
    		$list = $this->addWithParent($list, $entry->getParent());
    	}
    	
    	return $list;
    }
    
    /**
     * 
     * @param unknown $request
     * @param unknown $paramClass
     * @param unknown $template
     */
    protected function getParam($request, $paramClass, $template)
    {
    	$repository = $this->getDoctrine()->getRepository($paramClass);
    	$paramName = ClassUtils::getClassName($paramClass);
    	$name = $request->get($paramName, $template);
    	return $repository->findOneBy(['name' => $name]);
    }
    
    protected function getParamById($request, $paramClass, $template)
    {
    	$repository = $this->getDoctrine()->getRepository($paramClass);
    	$paramName = ClassUtils::getClassName($paramClass);
    	$id = $request->get($paramName, $template);
    	return $id ? $repository->find($id) : null;
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
    
    /**
     * 
     */
    protected function getHomeName() 
    {
    	return 'infomarket';
    }
    
    /**
     * 
     */
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
    	return 20;
    }
    
    protected function getIndexView()
    {
    	return $this->getHomeName() . '/' . $this->getEntityName() . '/index.html.twig';
    }
    
    protected function getShowView()
    {
    	return $this->getHomeName() . '/' . $this->getEntityName() . '/show.html.twig';
    }
    
    protected function getIndexRoute()
    {
    	return $this->getHomeName() . '_' . $this->getEntityName();
    }
    
    protected function getShowRoute()
    {
    	return $this->getIndexRoute() . '_show';
    }
}
