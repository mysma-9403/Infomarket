<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\SimpleEntityController;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\BrandFilter;
use AppBundle\Entity\Filter\ProductFilter;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Form\Filter\BrandFilterType;
use AppBundle\Form\Filter\CategoryFilterType;
use AppBundle\Form\Filter\ProductFilterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SiteController extends SimpleEntityController
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\HomeController::indexAction()
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
// 	/**
// 	 * 
// 	 * {@inheritDoc}
// 	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::indexActionInternal()
// 	 */
// 	protected function indexActionInternal(Request $request, $page)
// 	{
// // 		$logger = $this->get('logger');
// // 		$logger->info('[Infoprodukt] Category: ' . $params['category']->getName());
		
// 		$params = $this->getIndexParams($request, $page);
		
// 		$filterParams = [];
		
// 		if($params['category']) {
// 			$filterParams['category'] = $params['category']->getName();
// 		}
// 		if($params['brand']) {
// 			$filterParams['brand'] = $params['brand']->getName();
// 		}
// 		if($params['segment']) {
// 			$filterParams['segment'] = $params['segment']->getName();
// 		}
		
		
		
// 		$categoryFilter = $params['categoryFilter'];
// 		$categoryFilterForm = $this->createForm(CategoryFilterType::class, $categoryFilter);
		
// 		$brandFilter = $params['brandFilter'];
// 		$brandFilterForm = $this->createForm(BrandFilterType::class, $brandFilter);
		
// 		$entryFilter = $params['entryFilter'];
// 		$productFilterForm = $this->createForm(ProductFilterType::class, $entryFilter);
		
		
		
// 		$categoryFilterForm->handleRequest($request);
		
// 		if ($categoryFilterForm->isSubmitted() && $categoryFilterForm->isValid()) {
// 			if ($categoryFilterForm->get('search')->isClicked()) {
// 				$params = $categoryFilter->getValues();
// 				$params = array_merge($params, $brandFilter->getValues());
// 				$params = array_merge($params, $entryFilter->getValues());
// 				$params = array_merge($params, $filterParams);
				
// 				$filterParams = array_merge($filterParams, $categoryFilter->getValues());
// 				$filterParams = array_merge($filterParams, $brandFilter->getValues());
// 				$filterParams = array_merge($filterParams, $entryFilter->getValues());
// 				$params['filterParams'] = $filterParams; 
// 				return $this->redirectToRoute($this->getIndexRoute(), $params);
// 			}
// 		}
// 		$params['categoryFilterForm'] = $categoryFilterForm->createView();
		
		
		
// 		$brandFilterForm->handleRequest($request);
		
// 		if ($brandFilterForm->isSubmitted() && $brandFilterForm->isValid()) {
// 			if ($brandFilterForm->get('search')->isClicked()) {
// 				$params = $categoryFilter->getValues();
// 				$params = array_merge($params, $brandFilter->getValues());
// 				$params = array_merge($params, $entryFilter->getValues());
// 				$params = array_merge($params, $filterParams);
				
// 				$filterParams = array_merge($filterParams, $categoryFilter->getValues());
// 				$filterParams = array_merge($filterParams, $brandFilter->getValues());
// 				$filterParams = array_merge($filterParams, $entryFilter->getValues());
// 				$params['filterParams'] = $filterParams; 
// 				return $this->redirectToRoute($this->getIndexRoute(), $params);
// 			}
// 		}
// 		$params['brandFilterForm'] = $brandFilterForm->createView();
		
		
		
// 		$productFilterForm->handleRequest($request);
		
// 		if ($productFilterForm->isSubmitted() && $productFilterForm->isValid()) {
// 			if ($productFilterForm->get('search')->isClicked()) {
// 				$params = $categoryFilter->getValues();
// 				$params = array_merge($params, $brandFilter->getValues());
// 				$params = array_merge($params, $entryFilter->getValues());
// 				$params = array_merge($params, $filterParams);
				
// 				$filterParams = array_merge($filterParams, $categoryFilter->getValues());
// 				$filterParams = array_merge($filterParams, $brandFilter->getValues());
// 				$filterParams = array_merge($filterParams, $entryFilter->getValues());
// 				$params['filterParams'] = $filterParams; 
// 				return $this->redirectToRoute($this->getIndexRoute(), $params);
// 			}
// 		}
// 		$params['productFilterForm'] = $productFilterForm->createView();
		
		
// 		$filterParams = array_merge($filterParams, $categoryFilter->getValues());
// 		$filterParams = array_merge($filterParams, $brandFilter->getValues());
// 		$filterParams = array_merge($filterParams, $entryFilter->getValues());
// 		$params['filterParams'] = $filterParams;
		
// 		return $this->render($this->getIndexView(), $params);
// 	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getIndexParams()
	 */
	protected function getIndexParams(Request $request, $page)
	{
		$params = parent::getIndexParams($request, $page);
		
		
		
		$brandFilter = new BrandFilter();
		$brandFilter->initValues($request);
		$brandFilter->setPublished(BrandFilter::TRUE_VALUES);
    	$brands = $this->getParamList(Brand::class, $brandFilter);
    	
    	$brand = $this->getParamByName($request, Brand::class, null);
    	
    	$params['brandFilter'] = $brandFilter;
    	$params['brands'] = $brands;
    	$params['brand'] = $brand;
    	
    	
    	
    	$segmentFilter = new SimpleEntityFilter();
    	$segments = $this->getParamList(Segment::class, $segmentFilter);
    	 
    	$segment = $this->getParamByName($request, Segment::class, null);
    	
    	$params['segments'] = $segments;
    	
    	$params['segment'] = $segment;
    	
    	
    	
    	return $params;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\HomeController::getEntityType()
	 */
	protected function getEntityType()
	{
		return Product::class;
	}
	
	protected function getEntityFilter(Request $request)
	{
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
		$segmentRepository = $this->getDoctrine()->getRepository(Segment::class);
		
		$filter = new ProductFilter($categoryRepository, $brandRepository, $segmentRepository);
		$filter->setPublished(true);
		 
		$category = $this->getParamByName($request, Category::class, null);
		if($category) {
			$filter->setCategories([$category]);
		}
		
		$brand = $this->getParamByName($request, Brand::class, null);
		if($brand) {
			$filter->setBrands([$brand]);
		}
		
		$segment = $this->getParamByName($request, Segment::class, null);
		if($segment) {
			$filter->setSegments([$segment]);
		}
		 
		return $filter;
	}
	
	protected function getEntityName()
	{
		return 'home';
	}
	
    protected function getHomeName()
    {
    	return 'infoprodukt';
    }
    
    protected function initBranch(Request $request, $branches)
    {
    	return $this->getParamByName($request, Branch::class, null);
    }
    
    protected function showRootCategories()
    {
    	return false;
    }
}
