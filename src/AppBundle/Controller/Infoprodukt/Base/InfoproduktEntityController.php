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
use AppBundle\Entity\Page;
use AppBundle\Entity\Filter\PageFilter;
use AppBundle\Entity\Filter\LinkFilter;
use AppBundle\Entity\Link;
use AppBundle\Entity\Base\Audit;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;

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
    	$categoryFilter->setFeatured(true);
    	$categoryFilter->setPreleaf(true);
//     	$categoryFilter->setRoot(true);
    
    	$categories = $this->getParamList(Category::class, $categoryFilter);
    	$params['categories'] = $categories;
    	
    	$pageFilter = new PageFilter();
    	$pageFilter->setPublished(true);
    	$pageFilter->setFeatured(true);
    	
    	$pages = $this->getParamList(Page::class, $pageFilter);
    	$params['pages'] = $pages;
    	
    	$linkFilter = new LinkFilter();
    	$linkFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$linkFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
    	$linkFilter->setType(Link::FOOTER_LINK);
    	
    	$links = $this->getParamList(Link::class, $linkFilter);
    	$params['links'] = $links;
    
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
