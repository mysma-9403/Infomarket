<?php

namespace AppBundle\Controller\Infoprodukt\Base;

use AppBundle\Controller\Base\BaseEntityController;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\Filter\LinkFilter;
use AppBundle\Entity\Filter\PageFilter;
use AppBundle\Entity\Link;
use AppBundle\Entity\Page;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Filter\BranchFilter;
use AppBundle\Entity\Filter\AdvertFilter;
use AppBundle\Entity\Advert;

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
				return $this->redirectToRoute('infoprodukt_search', $searchFilter->getValues());
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
				return $this->redirectToRoute('infoprodukt_search', $searchFilter->getValues());
			}
		}
		$params['searchFilterForm'] = $searchFilterForm->createView();
	
		return $this->render($this->getShowView(), $params);
	}
	
	/*
	 * Params 
	 */
	
	
	
    protected function getParams(Request $request)
    {
    	$params = parent::getParams($request);
    	
    	$params = array_merge($params, $this->getAdvertParams($request));
    	
    	$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
    	$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
    	
    	$branchFilter = new BranchFilter($categoryRepository);
    	$branchFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
    	$branchFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
    	
    	$branches = $this->getParamList(Branch::class, $branchFilter);
    	$params['menuBranches'] = $branches;
    	
    	$categoryFilter = new CategoryFilter($branchRepository, $categoryRepository);
    	$categoryFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
    	$categoryFilter->setFeatured(SimpleEntityFilter::TRUE_VALUES);
    	$categoryFilter->setPreleaf(SimpleEntityFilter::TRUE_VALUES);
    	$categoryFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
    
    	$categories = $this->getParamList(Category::class, $categoryFilter);
    	$params['menuCategories'] = $categories;
    	
    	$pageFilter = new PageFilter();
    	$pageFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
    	$pageFilter->setFeatured(SimpleEntityFilter::TRUE_VALUES);
    	$pageFilter->setOrderBy('e.orderNumber ASC');
    	
    	$pages = $this->getParamList(Page::class, $pageFilter);
    	$params['menuPages'] = $pages;
    	
    	$linkFilter = new LinkFilter();
    	$linkFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$linkFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
    	$linkFilter->setTypes([Link::FOOTER_LINK]);
    	$linkFilter->setOrderBy('e.orderNumber ASC');
    	
    	$links = $this->getParamList(Link::class, $linkFilter);
    	$params['menuLinks'] = $links;
    
    	return $params;
    }
    
    protected function getRouteParams(Request $request) {
    	$routeParams = parent::getRouteParams($request);
    	
    	$category = $this->getParamById($request, Category::class, null);
    	if($category) {
    		$routeParams['category'] = $category->getId();
    	}
    
    	return $routeParams;
    }
    
    protected function getRoutingParams(Request $request)
    {
    	$params = parent::getRoutingParams($request);
    	
    	$category = $this->getParamById($request, Category::class, null);
		$params['category'] = $category;
    	
    	return $params;
    }
    
    protected function getAdvertParams(Request $request)
    {
    	$params = array();
    	
    	$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
    	
    	$advertFilter = new AdvertFilter($categoryRepository);
	    $advertFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
	    
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
    
    /*
     * Other 
     */
    
    
    protected function getBaseName() 
    {
    	return 'infoprodukt';
    }
}
