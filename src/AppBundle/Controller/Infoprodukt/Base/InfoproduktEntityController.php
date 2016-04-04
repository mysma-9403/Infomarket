<?php

namespace AppBundle\Controller\Infoprodukt\Base;

use AppBundle\Controller\Base\BaseEntityController;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class InfoproduktEntityController extends BaseEntityController
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::indexActionInternal()
	 */
	protected function indexActionInternal(Request $request, $page)
	{
		$params = $this->getIndexParams($request, $page);
		
		
	
		$searchFilter = new SimpleEntityFilter();
		$searchFilter->initValues($request);
	
		$searchFilterForm = $this->createForm(SimpleEntityFilterType::class, $searchFilter);
		$searchFilterForm->handleRequest($request);

		if ($searchFilterForm->isSubmitted() && $searchFilterForm->isValid()) {
			if ($searchFilterForm->get('search')->isClicked()) {
				$routingParams = $params['routingParams'];
				$routingParams = array_merge($routingParams, $searchFilter->getValues());

				return $this->redirectToRoute('infoprodukt_search', $routingParams);
			}
		}
		$params['searchFilterForm'] = $searchFilterForm->createView();
	
		return $this->render($this->getIndexView(), $params);
	}
	
	protected function showActionInternal(Request $request, $id)
	{
		$params = $this->getShowParams($request, $id);
	
	
	
		$searchFilter = new SimpleEntityFilter();
		$searchFilter->initValues($request);
	
		$searchFilterForm = $this->createForm(SimpleEntityFilterType::class, $searchFilter);
		$searchFilterForm->handleRequest($request);
	
		if ($searchFilterForm->isSubmitted() && $searchFilterForm->isValid()) {
			if ($searchFilterForm->get('search')->isClicked()) {
				$routingParams = $params['routingParams'];
				$routingParams = array_merge($routingParams, $searchFilter->getValues());
	
				return $this->redirectToRoute('infoprodukt_search', $routingParams);
			}
		}
		$params['searchFilterForm'] = $searchFilterForm->createView();
	
		return $this->render($this->getShowView(), $params);
	}
	
    protected function getParams(Request $request)
    {
    	$params = parent::getParams($request);
    
    
    
    	$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
    	$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
    	
    	$categoryFilter = new CategoryFilter($branchRepository, $categoryRepository);
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
