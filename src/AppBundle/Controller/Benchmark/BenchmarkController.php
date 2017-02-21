<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Base\DummyController;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\CategoryFilter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Filter\Benchmark\SubcategoryFilter;
use AppBundle\Filter\Benchmark\Washer\CentrifugeFilter;
use AppBundle\Filter\Benchmark\Washer\WasherCentrifugeFilter;
use AppBundle\Filter\Benchmark\Washer\WasherFilter;
use AppBundle\Form\Benchmark\CategoryFilterType;
use AppBundle\Form\Benchmark\ProductFilterType;
use AppBundle\Form\Benchmark\SubcategoryFilterType;
use AppBundle\Form\Benchmark\Washer\CentrifugeFilterType;
use AppBundle\Form\Benchmark\Washer\WasherCentrifugeFilterType;
use AppBundle\Form\Benchmark\Washer\WasherFilterType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Benchmark\ProductManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Manager\Route\RouteManager;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Repository\Benchmark\Washer\WasherRepository;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkController extends DummyController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}
	
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::indexActionInternal()
	 */
	protected function indexActionInternal(Request $request, $page)
	{
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		
		$category = $contextParams['category'];
		$categoryFilter = new CategoryFilter();
		$categoryFilter->setCategory($category);

		$categoryFilterForm = $this->createForm(CategoryFilterType::class, $categoryFilter);
		$categoryFilterForm->handleRequest($request);

		if ($categoryFilterForm->isSubmitted() && $categoryFilterForm->isValid()) {
			if ($categoryFilterForm->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $categoryFilter->getRequestValues());
			}
		}
		$viewParams['categoryFilter'] = $categoryFilterForm->createView();		
		
		
		$subcategory = $contextParams['subcategory'];
		$subcategoryFilter = new SubcategoryFilter();
		$subcategoryFilter->setSubcategory($subcategory);
		
		$subcategoryFilterForm = $this->createForm(SubcategoryFilterType::class, $subcategoryFilter, ['category' => $category]);
		$subcategoryFilterForm->handleRequest($request);
		
		if ($subcategoryFilterForm->isSubmitted() && $subcategoryFilterForm->isValid()) {
			if ($subcategoryFilterForm->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $subcategoryFilter->getRequestValues());
			}
		}
		$viewParams['subcategoryFilter'] = $subcategoryFilterForm->createView();
		
		
		
		$filter = $viewParams['entryFilter'];
		$subcategoryObject = $viewParams['subcategory'];
	
		$filterForm = $this->createForm($this->getFilterFormType($subcategoryObject['benchmarkType']), $filter, ['category' => $subcategory]);
		$filterForm->handleRequest($request);
	
		if ($filterForm->isSubmitted() && $filterForm->isValid()) {
			
			if ($filterForm->get('search')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getRequestValues());
			}
			
			if ($filterForm->get('clear')->isClicked()) {
				$filter->clearRequestValues();
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getRequestValues());
			}
		}
		$viewParams['filter'] = $filterForm->createView();
		
		return $this->render($this->getIndexView(), $viewParams);
	}
	
	//---------------------------------------------------------------------------
	// Parameters
	//---------------------------------------------------------------------------
	
	protected function getParams(Request $request, array $params) {
		$params = parent::getParams($request, $params);
	
		$cpm = $this->getContextParamsManager($request);
		$params = $cpm->getParams($request, $params);
	
		return $params;
	}
	
	protected function getIndexParams(Request $request, array $params, $page) {
		$params = $this->getParams($request, $params);
	
		$viewParams = $params['viewParams'];
		$subcategory = $viewParams['subcategory'];
	
		$em = $this->getEntryParamsManager($subcategory['benchmarkType']);
		$params = $em->getIndexParams($request, $params, $page);
	
		return $params;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getContextParamsManager(Request $request) {
		$doctrine = $this->getDoctrine();
	
		$rm = new RouteManager();
		$lastRoute = $rm->getLastRoute($request, $this->getHomeRoute());
		$lastRouteParams = $lastRoute['routeParams'];
	
		if(!$lastRouteParams) {
			$lastRouteParams = array();
		}
	
		return new ContextParamsManager($doctrine, $lastRouteParams);
	}
	
	protected function getEntryParamsManager($benchmark) { 
		$doctrine = $this->getDoctrine();
		$paginator = $this->get('knp_paginator');
	
		$em = $this->getEntityManager($doctrine, $paginator, $benchmark);
		$fm = $this->getFilterManager($doctrine, $benchmark);
	
		return $this->getInternalEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new EntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator, $benchmark) {
		$repository = null;
		
		$em = $this->getDoctrine()->getManager();
		
		switch($benchmark) {
			case Category::WASHER:
				$repository = new WasherRepository($em, $em->getClassMetadata(Product::class));
				break;
			case Category::CENTRIFUGE:
				$repository = new WasherRepository($em, $em->getClassMetadata(Product::class));
				break;
			case Category::WASHER_CENTRIFUGE:
				$repository = new WasherRepository($em, $em->getClassMetadata(Product::class));
				break;
			default:
				$repository = new ProductRepository($em, $em->getClassMetadata(Product::class));
		}
		
		return new ProductManager($doctrine, $paginator, $repository);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getFilterManager()
	 */
	protected function getFilterManager($doctrine, $benchmark) {
		$filter = null;
		
		switch($benchmark) {
			case Category::WASHER:
				$filter = new WasherFilter();
				break;
			case Category::CENTRIFUGE:
				$filter = new CentrifugeFilter();
				break;
			case Category::WASHER_CENTRIFUGE:
				$filter = new WasherCentrifugeFilter();
				break;
			default:
				$filter = new ProductFilter();
		}
		
		return new FilterManager($filter);
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	protected function getFilterFormType($benchmark) {
		switch($benchmark) {
			case Category::WASHER:
				return WasherFilterType::class;
			case Category::CENTRIFUGE:
				return CentrifugeFilterType::class;
			case Category::WASHER_CENTRIFUGE:
				return WasherCentrifugeFilterType::class;
			default:
				return ProductFilterType::class;
		}
	}
	
	protected function getEntityType() {
		return Product::class;
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	
	protected function getShowRole() {
		return 'ROLE_BENCHMARK';
	}
	
	//---------------------------------------------------------------------------
	// Views
	//---------------------------------------------------------------------------
	
	protected function getIndexView()
	{
		return $this->getDomain() . '/' . $this->getEntityName() . '/index.html.twig';
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	protected function getIndexRoute()
	{
		return $this->getDomain() . '_' . $this->getEntityName();
	}
	
	protected function getHomeRoute() {
		return array('route' => $this->getIndexView(), 'routeParams' => array());
	}
	
	
	//---------------------------------------------------------------------------
	// Domain
	//---------------------------------------------------------------------------
	
	protected function getDomain() {
		return 'benchmark';
	}
}