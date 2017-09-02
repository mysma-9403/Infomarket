<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Base\DummyController;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Category;
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
use AppBundle\Manager\Route\RouteManager;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Repository\Benchmark\SegmentRepository;
use AppBundle\Repository\Common\BenchmarkFieldMetadataRepository;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends DummyController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}
	
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	protected function showActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getShowRoute());
		$params = $this->getShowParams($request, $params, $id);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		//TODO refactor forms like in other controllers
		$category = $contextParams['category'];
		$categoryFilter = new CategoryFilter();
		$categoryFilter->setCategory($category);
		
		$categoryFilterForm = $this->createForm(CategoryFilterType::class, $categoryFilter, $this->getCategoryFormOptions($params));
		$categoryFilterForm->handleRequest($request);

		if ($categoryFilterForm->isSubmitted() && $categoryFilterForm->isValid()) {
			if ($categoryFilterForm->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getShowRoute(), $categoryFilter->getRequestValues());
			}
		}
		$viewParams['categoryFilter'] = $categoryFilterForm->createView();	
		
		
		$subcategory = $contextParams['subcategory'];
		$subcategoryFilter = new SubcategoryFilter();
		$subcategoryFilter->setSubcategory($subcategory);
		
		//----- other method
		
		$subcategoryFilterForm = $this->createForm(SubcategoryFilterType::class, $subcategoryFilter, $this->getSubcategoryFormOptions($params));
		$subcategoryFilterForm->handleRequest($request);
		
		if ($subcategoryFilterForm->isSubmitted() && $subcategoryFilterForm->isValid()) {
			if ($subcategoryFilterForm->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getShowRoute(), $subcategoryFilter->getRequestValues());
			}
		}
		$viewParams['subcategoryFilter'] = $subcategoryFilterForm->createView();
		
		
		
		$routeParams = $params['routeParams'];
		$viewParams['routeParams'] = $routeParams;
		
		return $this->render($this->getShowView(), $viewParams);
	}
	
	//---------------------------------------------------------------------------
	// Form Options
	//---------------------------------------------------------------------------
	
	protected function getCategoryFormOptions(array $params) {
		$options = [];
		
		$contextParams = $params['contextParams'];
		$userId = $contextParams['user'];
		
		$em = $this->getDoctrine()->getManager();
		$categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
		$choices = $categoryRepository->findFilterItemsByUser($userId);
		
		$this->addChoicesFormOption($options, $choices, 'category');
		
		return $options;
	}
	
	protected function getSubcategoryFormOptions(array $params) {
		$options = [];
	
		$contextParams = $params['contextParams'];
		$categoryId = $contextParams['category'];
		$userId = $contextParams['user'];
	
		$em = $this->getDoctrine()->getManager();
		$categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
		$choices = $categoryRepository->findFilterItemsByUserAndCategory($userId, $categoryId);
	
		$this->addChoicesFormOption($options, $choices, 'subcategory');
	
		return $options;
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
	
	protected function getShowParams(Request $request, array $params, $id) {
		$params = $this->getParams($request, $params);
	
		$em = $this->getEntryParamsManager();
		$params = $em->getShowParams($request, $params, $id);
	
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
	
		$tokenStorage = $this->get('security.token_storage');
		return new ContextParamsManager($doctrine, $lastRouteParams, $tokenStorage);
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

		//TODO services.yml!!!
		$translator = $this->get('translator');
		$chartLogic = new BenchmarkChartLogic($translator);
		
		/** @var ObjectManager $manager */
		$manager = $doctrine->getManager();
		
		$benchmarkFieldMetadataRepository = new BenchmarkFieldMetadataRepository($manager, $manager->getClassMetadata(BenchmarkField::class));
		$benchmarkFieldsProvider = new BenchmarkFieldsProvider($benchmarkFieldMetadataRepository, $translator);
		
		$benchmarkFieldDataBaseUtils = new BenchmarkFieldDataBaseUtils(); //TODO make service??
		
		$benchmarkFieldFactory = new CategoryBenchmarkFieldFactory($benchmarkFieldDataBaseUtils, $productRepository);
		$benchmarkFieldsInitializer = new BenchmarkFieldsInitializerImpl($benchmarkFieldFactory);
		
		$tokenStorage = $this->get('security.token_storage');
		
		return new CategoryParamsManager($em, $fm, $doctrine,
				$categoryRepository, $productRepository, $segmentRepository,
				$chartLogic, $benchmarkFieldsProvider, $benchmarkFieldsInitializer, $tokenStorage);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(CategoryManager::class);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new CategoryFilter());
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	protected function getFilterFormType() {
		return CategoryFilterType::class;
	}
	
	protected function getEntityType() {
		return Category::class;
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
	
	protected function getShowView()
	{
		return $this->getDomain() . '/' . $this->getEntityName() . '/show.html.twig';
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	protected function getIndexRoute()
	{
		return $this->getDomain() . '_' . $this->getEntityName();
	}
	
	protected function getShowRoute()
	{
		return $this->getIndexRoute() . '_show';
	}
	
	protected function getHomeRoute() {
		return array('route' => $this->getIndexRoute(), 'routeParams' => array());
	}
	
	
	//---------------------------------------------------------------------------
	// Domain
	//---------------------------------------------------------------------------
	
	protected function getDomain() {
		return 'benchmark';
	}
}