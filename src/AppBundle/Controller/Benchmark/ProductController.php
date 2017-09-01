<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Base\DummyController;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\BenchmarkQuery;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Factory\Common\BenchmarkField\CompareBenchmarkFieldFactory;
use AppBundle\Factory\Common\BenchmarkField\NoteBenchmarkFieldFactory;
use AppBundle\Factory\Common\BenchmarkField\SimpleBenchmarkFieldFactory;
use AppBundle\Factory\Common\Choices\Bool\BooleanChoicesFactory;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\CategoryFilter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Filter\Benchmark\SubcategoryFilter;
use AppBundle\Form\Filter\Benchmark\CategoryFilterType;
use AppBundle\Form\Filter\Benchmark\ProductFilterType;
use AppBundle\Form\Filter\Benchmark\SubcategoryFilterType;
use AppBundle\Logic\Benchmark\Export\CsvExportLogic;
use AppBundle\Logic\Benchmark\Export\ExcelExportLogic;
use AppBundle\Logic\Benchmark\Export\HtmlExportLogic;
use AppBundle\Logic\Benchmark\Export\ImageExportLogic;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializerImpl;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Benchmark\ProductManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;
use AppBundle\Manager\Params\EntryParams\Benchmark\ProductParamsManager;
use AppBundle\Manager\Route\RouteManager;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Repository\Benchmark\BrandRepository;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Repository\Common\BenchmarkFieldMetadataRepository;
use AppBundle\Utils\ClassUtils;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Validator\Constraints\Date;

class ProductController extends DummyController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}
	
	public function exportToImageAction(Request $request, $page) {
		return $this->exportToImageActionInternal($request, $page);
	}
	
	public function exportToPdfAction(Request $request, $page) {
		return $this->exportToPdfActionInternal($request, $page);
	}
	
	public function exportToCsvAction(Request $request, $page) {
		return $this->exportToCsvActionInternal($request, $page);
	}
	
	public function exportToHtmlAction(Request $request, $page) {
		return $this->exportToHtmlActionInternal($request, $page);
	}
	
	public function exportToExcelAction(Request $request, $page) {
		return $this->exportToExcelActionInternal($request, $page);
	}
	
	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}
	
	public function compareAction(Request $request, $id) {
		return $this->compareActionInternal($request, $id);
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
		
		//TODO refactor forms like in other controllers
		$category = $contextParams['category'];
		$categoryFilter = new CategoryFilter();
		$categoryFilter->setCategory($category);
		
		$categoryFilterForm = $this->createForm(CategoryFilterType::class, $categoryFilter, $this->getCategoryFormOptions($params));
		$categoryFilterForm->handleRequest($request);

		if ($categoryFilterForm->isSubmitted() && $categoryFilterForm->isValid()) {
			if ($categoryFilterForm->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $categoryFilter->getRequestValues());
			}
		}
		$viewParams['categoryFilter'] = $categoryFilterForm->createView();		
		
		//----- other method
		
		$subcategory = $contextParams['subcategory'];
		$subcategoryFilter = new SubcategoryFilter();
		$subcategoryFilter->setSubcategory($subcategory);
		
		$subcategoryFilterForm = $this->createForm(SubcategoryFilterType::class, $subcategoryFilter, $this->getSubcategoryFormOptions($params));
		$subcategoryFilterForm->handleRequest($request);
		
		if ($subcategoryFilterForm->isSubmitted() && $subcategoryFilterForm->isValid()) {
			if ($subcategoryFilterForm->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $subcategoryFilter->getRequestValues());
			}
		}
		$viewParams['subcategoryFilter'] = $subcategoryFilterForm->createView();
		
		
		
		$filter = $viewParams['entryFilter'];
		
		$filterForm = $this->createForm($this->getFilterFormType(), $filter, $this->getFilterFormOptions($params));
		$filterForm->handleRequest($request);
	
		if ($filterForm->isSubmitted() && $filterForm->isValid()) {
			
			if ($filterForm->get('saveQuery')->isClicked()) {
				$params = $filter->getRequestValues();
				$params['name'] = $this->getBenchmarkQueryName($subcategory);
				return $this->redirectToRoute($this->getCreateQueryRoute(), array_merge($contextParams, $params));
			}
			
			if ($filterForm->get('search')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getRequestValues());
			}
			
			if ($filterForm->get('clear')->isClicked()) {
				$filter->clearRequestValues();
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getRequestValues());
			}
		}
		$viewParams['filter'] = $filterForm->createView();
		
		$routeParams = $params['routeParams'];
		$viewParams['routeParams'] = $routeParams;
		
		return $this->render($this->getIndexView(), $viewParams);
	}
	
	protected function exportToImageActionInternal(Request $request, $page) {
		if ($this->container->has('profiler'))
			$this->container->get('profiler')->disable();
		
		$exportLogic = new ImageExportLogic();
		
		$html = $this->indexActionInternal($request, $page);
		$html = $exportLogic->clean($html);
		
		$date = new \DateTime();
		$response = new Response($this->get('knp_snappy.image')->getOutputFromHtml($html), 200,
				array(
						'Content-Type'          => 'image/jpg',
						'Content-Disposition'   => 'filename="'. $date->format('Y-m-d') . '-benchmark.jpg"'
				));
		
		return $response;
	}
	
	protected function exportToPdfActionInternal(Request $request, $page) {
		if ($this->container->has('profiler'))
			$this->container->get('profiler')->disable();
		
		$exportLogic = new ImageExportLogic();
		
		$html = $this->indexActionInternal($request, $page);
		$html = $exportLogic->clean($html);
		
		$date = new \DateTime();
		$response = new Response($this->get('knp_snappy.pdf')->getOutputFromHtml($html), 200,
				array(
						'Content-Type'          => 'application/pdf',
						'Content-Disposition'   => 'filename="'. $date->format('Y-m-d') . '-benchmark.pdf"'
				));
	
		return $response;
	}
	
	protected function exportToCsvActionInternal(Request $request, $page) {
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
		
		$viewParams = $params['viewParams'];
		$entries = $viewParams['entries'];
		/** @var ProductFilter $entryFilter */
		$entryFilter = $viewParams['entryFilter'];
		
		$response = new StreamedResponse();
		$response->setCallback(function() use(&$entryFilter, &$entries) {
			$logic = new CsvExportLogic();
			$logic->export($entryFilter, $entries);
		});
	
		$date = new \DateTime();
		$response->setStatusCode(200);
		$response->headers->set('Content-Type', 'text/csv; charset=utf-8');
		$response->headers->set('Content-Disposition', 'attachment; filename="'. $date->format('Y-m-d') . '-benchmark.csv"');

		return $response;
	}
	
	protected function exportToHtmlActionInternal(Request $request, $page) {
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
	
		$viewParams = $params['viewParams'];
		$entries = $viewParams['entries'];
		/** @var ProductFilter $entryFilter */
		$entryFilter = $viewParams['entryFilter'];
	
		$response = new StreamedResponse();
		$response->setCallback(function() use(&$entryFilter, &$entries) {
			$logic = new HtmlExportLogic();
			$logic->export($entryFilter, $entries);
		});
	
		$date = new \DateTime();
		$response->setStatusCode(200);
		$response->headers->set('Content-Type', 'text/html; charset=utf-8');
		$response->headers->set('Content-Disposition', 'attachment; filename="'. $date->format('Y-m-d') . '-benchmark.html"');

		return $response;
	}
	
	protected function exportToExcelActionInternal(Request $request, $page) {
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
	
		$viewParams = $params['viewParams'];
		$entries = $viewParams['entries'];
		/** @var ProductFilter $entryFilter */
		$entryFilter = $viewParams['entryFilter'];
	
		$response = new StreamedResponse();
		$response->setCallback(function() use(&$entryFilter, &$entries) {
			$logic = new ExcelExportLogic();
			$logic->export($entryFilter, $entries);
		});
	
		$date = new \DateTime();
		$response->setStatusCode(200);
		$response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		$response->headers->set('Content-Disposition', 'attachment; filename="'. $date->format('Y-m-d') . '-benchmark.xlsx"');

		return $response;
	}
	
	protected function showActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getShowRoute());
		$params = $this->getShowParams($request, $params, $id);
	
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
	
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		$viewParams = $params['viewParams'];
	
		return $this->render($this->getShowView(), $viewParams);
	}
	
	protected function compareActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getCompareRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getCompareRoute());
		$params = $this->getCompareParams($request, $params, $id);
	
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
	
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		$viewParams = $params['viewParams'];
	
		return $this->render($this->getCompareView(), $viewParams);
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getBenchmarkQueryName($subcategoryId) {
		$date = new \DateTime();
		
		/** @var BaseRepository $em */
		$repository = $this->getDoctrine()->getRepository(Category::class);
		/** @var Category $subcategory */
		$subcategory = $repository->find($subcategoryId);
		
		return $date->format('Y-m-d H:i ') . $subcategory->getDisplayName();
	}
	
	//---------------------------------------------------------------------------
	// Form options
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
	
	protected function getFilterFormOptions(array $params) {
		$options = [];
		
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		/** @var ProductFilter $filter */
		$filter = $viewParams['entryFilter'];
		$options['filter'] = $filter;
		
		$subcategoryId = $contextParams['subcategory'];
		$userId = $contextParams['user'];
		
		/** @var ObjectManager $em */
		$em = $this->getDoctrine()->getManager();
		
		$categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
		$choices = $categoryRepository->findFilterItemsByUserAndCategory($userId, $subcategoryId);
		$this->addChoicesFormOption($options, $choices, 'categories');
		
		$brandRepository = new BrandRepository($em, $em->getClassMetadata(Brand::class));
		$choices = $brandRepository->findFilterItemsByCategory($subcategoryId);
		$this->addChoicesFormOption($options, $choices, 'brands');
		
		$productRepository = $this->get(ProductRepository::class);
		
		$choices = [];
		foreach ($filter->getFilterFields() as $field) {
			$valueField = $field['valueField'];
			$choices[$valueField] = $productRepository->findFilterItemsByValue($subcategoryId, $valueField);
		}
		$options['choices'] = $choices;
		
		$this->addFactoryChoicesFormOption($options, BooleanChoicesFactory::class, 'boolean');
		
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
	
	protected function getIndexParams(Request $request, array $params, $page) {
		$params = $this->getParams($request, $params);
	
		$em = $this->getEntryParamsManager();
		$params = $em->getIndexParams($request, $params, $page);
	
		return $params;
	}
	
	protected function getShowParams(Request $request, array $params, $id) {
		$params = $this->getParams($request, $params);
	
		$em = $this->getEntryParamsManager();
		$params = $em->getShowParams($request, $params, $id);
	
		return $params;
	}
	
	protected function getCompareParams(Request $request, array $params, $id) {
		$params = $this->getParams($request, $params);
	
		$em = $this->getEntryParamsManager();
		$params = $em->getCompareParams($request, $params, $id);
	
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
		$tokenStorage = $this->get('security.token_storage');
		$translator = $this->get('translator');
		
		/** @var ObjectManager $manager */
		$manager = $doctrine->getManager();
		$benchmarkFieldMetadataRepository = new BenchmarkFieldMetadataRepository($manager, $manager->getClassMetadata(BenchmarkField::class));
		$benchmarkFieldsProvider = new BenchmarkFieldsProvider($benchmarkFieldMetadataRepository, $translator);
		
		$benchmarkFieldDataBaseUtils = new BenchmarkFieldDataBaseUtils(); // TODO service
		$productRepository = new ProductRepository($manager, $manager->getClassMetadata(Product::class));
		
		$showBenchmarkFieldFactory = new NoteBenchmarkFieldFactory($benchmarkFieldDataBaseUtils, $productRepository);
		$showBenchmarkFieldsInitializer = new BenchmarkFieldsInitializerImpl($showBenchmarkFieldFactory);
		
		$compareBenchmarkFieldFactory = new CompareBenchmarkFieldFactory($benchmarkFieldDataBaseUtils, $productRepository);
		$compareBenchmarkFieldsInitializer = new BenchmarkFieldsInitializerImpl($compareBenchmarkFieldFactory);
		
		return new ProductParamsManager($em, $fm, $doctrine, $tokenStorage,
				$benchmarkFieldsProvider,
				$showBenchmarkFieldsInitializer,
				$compareBenchmarkFieldsInitializer);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(ProductManager::class);
	}
	
	protected function getFilterManager($doctrine) {
		$em = $doctrine->getManager();
		$benchmarkFieldMetadataRepository = new BenchmarkFieldMetadataRepository($em, $em->getClassMetadata(BenchmarkField::class));
		
		$translator = $this->get('translator');
		
		$benchmarkFieldsProvider = new BenchmarkFieldsProvider($benchmarkFieldMetadataRepository, $translator);
		
		$benchmarkFieldDataBaseUtils = new BenchmarkFieldDataBaseUtils();
		$benchmarkFieldFactory = new SimpleBenchmarkFieldFactory($benchmarkFieldDataBaseUtils);
		$benchmarkFieldsInitializer = new BenchmarkFieldsInitializerImpl($benchmarkFieldFactory);
		
		return new FilterManager(new ProductFilter($benchmarkFieldsProvider, $benchmarkFieldsInitializer, $benchmarkFieldsInitializer));
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	protected function getFilterFormType() {
		return ProductFilterType::class;
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
	
	protected function getCompareRole() {
		return $this->getShowRole();
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
	
	protected function getCompareView()
	{
		return $this->getDomain() . '/' . $this->getEntityName() . '/compare.html.twig';
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
	
	protected function getCompareRoute()
	{
		return $this->getIndexRoute() . '_compare';
	}
	
	protected function getCreateQueryRoute() {
		return $this->getDomain() . '_' . ClassUtils::getUnderscoreName(BenchmarkQuery::class) . '_new';
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