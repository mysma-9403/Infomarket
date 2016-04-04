<?php

namespace AppBundle\Controller\Infoprodukt\Base;

use AppBundle\Controller\Base\BaseEntityController;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\BranchFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Filter\CategoryFilterType;

abstract class InfoproduktEntityController extends BaseEntityController
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::indexActionInternal()
	 */
	protected function indexActionInternal(Request $request, $page)
	{
		// 		$logger = $this->get('logger');
		// 		$logger->info('[Infoprodukt] Category: ' . $params['category']->getName());
	
		$params = $this->getIndexParams($request, $page);
	
	
	
	
		$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		 
		$categoryFilter = new CategoryFilter($branchRepository, $categoryRepository);
		$categoryFilter->initValues($request);
		 
		$categoryFilterForm = $this->createForm(CategoryFilterType::class, $categoryFilter);
		$categoryFilterForm->handleRequest($request);
	
		if ($categoryFilterForm->isSubmitted() && $categoryFilterForm->isValid()) {
			if ($categoryFilterForm->get('search')->isClicked()) {
				$routingParams = $params['routingParams'];
				$routingParams = array_merge($routingParams, $categoryFilter->getValues());
	
				return $this->redirectToRoute($this->getIndexRoute(), $routingParams);
			}
		}
		$params['categoryFilterForm'] = $categoryFilterForm->createView();
	
		return $this->render($this->getIndexView(), $params);
	}
	
    protected function getParams(Request $request)
    {
    	$params = parent::getParams($request);
    	
    	$branchFilter = new BranchFilter();
    	$branchFilter->initValues($request);
    	$branchFilter->setPublished(true);
    	
    	$branches = $this->getParamList(Branch::class, $branchFilter);
    	$params['branches'] = $branches;
    
    
    
    	$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
    	$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
    	
    	$categoryFilter = new CategoryFilter($branchRepository, $categoryRepository);
    	$categoryFilter->initValues($request);
    	$categoryFilter->setPublished(true);
    	$categoryFilter->setPreleaf(true);
    
    	$categories = $this->getParamList(Category::class, $categoryFilter);
    	$params['categories'] = $categories;
    
    	return $params;
    }
    
    protected function getRoutingParams(Request $request)
    {
    	$params = parent::getRoutingParams($request);
    	
    	$category = $this->getParamById($request, Category::class, null);
    	if($category) {
    		$params['category'] = $category->getId();
    	}
    	 
    	return $params;
    }
    
    protected function getBaseName() 
    {
    	return 'infoprodukt';
    }
}
