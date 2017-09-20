<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Base\DummyController;
use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\Category;
use AppBundle\Factory\Common\BenchmarkField\CategoryBenchmarkFieldFactory;
use AppBundle\Filter\Benchmark\CategoryFilter;
use AppBundle\Filter\Benchmark\SubcategoryFilter;
use AppBundle\Form\Filter\Benchmark\CategoryFilterType;
use AppBundle\Form\Filter\Benchmark\SubcategoryFilterType;
use AppBundle\Logic\Benchmark\Fields\BenchmarkChartLogic;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializerImpl;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Benchmark\CategoryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;
use AppBundle\Manager\Params\EntryParams\Benchmark\CategoryParamsManager;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Repository\Benchmark\SegmentRepository;
use AppBundle\Repository\Common\BenchmarkFieldMetadataRepository;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends DummyController {
	
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	
	//TODO maybe should be moved to some common controller, if forms are not needed, can be empty :)
	protected function showActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getShowRoute());
		$params = $this->getShowParams($request, $params, $id);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		$response = $this->initShowForms($request, $params);
		if ($response)
			return $response;
		
		$routeParams = $params['routeParams'];
		
		$viewParams = $params['viewParams'];
		$viewParams['routeParams'] = $routeParams;
		
		return $this->render($this->getShowView(), $viewParams);
	}
	
	// ---------------------------------------------------------------------------
	// Forms
	// ---------------------------------------------------------------------------
	
	protected function initShowForms(Request $request, array &$params) {
		$response = $this->initCategoryForm($request, $params);
		if ($response) {
			return $response;
		}
	
		$response = $this->initSubcategoryForm($request, $params);
		if ($response) {
			return $response;
		}
	
		return null;
	}
	
	//TODO same like in ProductController (except route) -> refactor
	protected function initCategoryForm(Request $request, array &$params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
	
		//TODO should be taken from params??
		$category = $contextParams['category'];
		$filter = new CategoryFilter();
		$filter->setCategory($category);
	
		$optionsProvider = $this->getCategoryFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
	
		$form = $this->createForm(CategoryFilterType::class, $filter, $options);
	
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid()) {
			if ($form->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getShowRoute(), $filter->getRequestValues());
			}
		}
	
		$viewParams['categoryFilterForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
	
		return null;
	}
	
	//TODO same like in ProductController (except route) -> refactor
	protected function initSubcategoryForm(Request $request, array &$params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
	
		//TODO should be taken from params??
		$subcategory = $contextParams['subcategory'];
		$filter = new SubcategoryFilter();
		$filter->setSubcategory($subcategory);
	
		$optionsProvider = $this->getSubcategoryFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
	
		$form = $this->createForm(SubcategoryFilterType::class, $filter, $options);
	
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid()) {
			if ($form->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getShowRoute(), $filter->getRequestValues());
			}
		}
	
		$viewParams['subcategoryFilterForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
	
		return null;
	}
	
	// ---------------------------------------------------------------------------
	// Form Options
	// ---------------------------------------------------------------------------
	protected function getCategoryFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.benchmark.product_category');
	}
	
	protected function getSubcategoryFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.benchmark.product_subcategory');
	}
	
	// ---------------------------------------------------------------------------
	// Parameters
	// ---------------------------------------------------------------------------
	protected function getParams(Request $request, array $params) {
		$params = parent::getParams($request, $params);
		
		$cpm = $this->getContextParamsManager($request);
		$params = $cpm->getParams($request, $params);
		
		return $params;
	}

	protected function getShowParams(Request $request, array $params, $id) {
		$params = $this->getParams($request, $params);
		
		$em = $this->getEntryParamsManager();
		$params = $em->getShowParams($request, $params, $id);
		
		return $params;
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getContextParamsManager(Request $request) {
		return $this->get(ContextParamsManager::class);
	}

	protected function getEntryParamsManager() {
		$doctrine = $this->getDoctrine();
		$paginator = $this->get('knp_paginator');
		
		$em = $this->getEntityManager($doctrine, $paginator);
		$fm = $this->getFilterManager($doctrine);
		
		return $this->getInternalEntryParamsManager($em, $fm, $doctrine);
	}

	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$categoryRepository = $this->get(CategoryRepository::class);
		$productRepository = $this->get(ProductRepository::class);
		$segmentRepository = $this->get(SegmentRepository::class);
		
		// TODO services.yml!!!
		$translator = $this->get('translator');
		$chartLogic = new BenchmarkChartLogic($translator);
		
		/** @var ObjectManager $manager */
		$manager = $doctrine->getManager();
		
		$benchmarkFieldMetadataRepository = new BenchmarkFieldMetadataRepository($manager, 
				$manager->getClassMetadata(BenchmarkField::class));
		$benchmarkFieldsProvider = new BenchmarkFieldsProvider($benchmarkFieldMetadataRepository, $translator);
		
		$benchmarkFieldDataBaseUtils = new BenchmarkFieldDataBaseUtils(); // TODO make service??
		
		$benchmarkFieldFactory = new CategoryBenchmarkFieldFactory($benchmarkFieldDataBaseUtils, 
				$productRepository);
		$benchmarkFieldsInitializer = new BenchmarkFieldsInitializerImpl($benchmarkFieldFactory);
		
		$tokenStorage = $this->get('security.token_storage');
		
		return new CategoryParamsManager($em, $fm, $categoryRepository, $productRepository, $segmentRepository, 
				$chartLogic, $benchmarkFieldsProvider, $benchmarkFieldsInitializer, $tokenStorage);
	}

	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(CategoryManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new CategoryFilter());
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function getFilterFormType() {
		return CategoryFilterType::class;
	}

	protected function getEntityType() {
		return Category::class;
	}
	
	// ---------------------------------------------------------------------------
	// Roles
	// ---------------------------------------------------------------------------
	protected function getShowRole() {
		return 'ROLE_BENCHMARK';
	}
	
	// ---------------------------------------------------------------------------
	// Views
	// ---------------------------------------------------------------------------
	protected function getIndexView() {
		return $this->getDomain() . '/' . $this->getEntityName() . '/index.html.twig';
	}

	protected function getShowView() {
		return $this->getDomain() . '/' . $this->getEntityName() . '/show.html.twig';
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getIndexRoute() {
		return $this->getDomain() . '_' . $this->getEntityName();
	}

	protected function getShowRoute() {
		return $this->getIndexRoute() . '_show';
	}

	protected function getHomeRoute() {
		return array('route' => $this->getIndexRoute(), 'routeParams' => array());
	}
	
	// ---------------------------------------------------------------------------
	// Domain
	// ---------------------------------------------------------------------------
	protected function getDomain() {
		return 'benchmark';
	}
}