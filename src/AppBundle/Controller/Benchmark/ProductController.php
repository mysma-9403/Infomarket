<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Benchmark\Base\BenchmarkStandardController;
use AppBundle\Entity\Main\BenchmarkQuery;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Factory\Common\BenchmarkField\CompareBenchmarkFieldFactory;
use AppBundle\Factory\Common\BenchmarkField\FilterBenchmarkFieldFactory;
use AppBundle\Factory\Common\BenchmarkField\NoteBenchmarkFieldFactory;
use AppBundle\Factory\Common\BenchmarkField\SimpleBenchmarkFieldFactory;
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
use AppBundle\Logic\Common\BenchmarkField\Distribution\DistributionCalculator;
use AppBundle\Logic\Common\BenchmarkField\Distribution\ScoreDistributionCalculator;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializer;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Logic\Common\Product\NeighboursFinder\NeighboursFinder;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Benchmark\ProductManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Benchmark\ProductParamsManager;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Repository\Benchmark\BenchmarkMessageRepository;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Utils\ClassUtils;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Validator\Constraints\Date;

class ProductController extends BenchmarkStandardController {
	
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
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
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	protected function compareActionInternal(Request $request, $id) {
		if ($this->getShowRole() != 'ROLE_GUEST') {
			$this->denyAccessUnlessGranted($this->getCompareRole(), null, 'Unable to access this page!');
		}
		
		$params = $this->createParams($this->getCompareRoute());
		$params = $this->getCompareParams($request, $params, $id);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		$viewParams = $params['viewParams'];
		
		$response = $this->initCompareForms($request, $params);
		if ($response)
			return $response;
		
		$routeParams = $params['routeParams'];
		
		$viewParams = $params['viewParams'];
		$viewParams['routeParams'] = $routeParams;
		
		return $this->render($this->getCompareView(), $viewParams);
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
						'Content-Type' => 'image/jpg', 
						'Content-Disposition' => 'filename="' . $date->format('Y-m-d') . '-benchmark.jpg"'));
		
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
						'Content-Type' => 'application/pdf', 
						'Content-Disposition' => 'filename="' . $date->format('Y-m-d') . '-benchmark.pdf"'));
		
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
		$response->setCallback(
				function () use (&$entryFilter, &$entries) {
					$logic = new CsvExportLogic();
					$logic->export($entryFilter, $entries);
				});
		
		$date = new \DateTime();
		$response->setStatusCode(200);
		$response->headers->set('Content-Type', 'text/csv; charset=utf-8');
		$response->headers->set('Content-Disposition', 
				'attachment; filename="' . $date->format('Y-m-d') . '-benchmark.csv"');
		
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
		$response->setCallback(
				function () use (&$entryFilter, &$entries) {
					$logic = new HtmlExportLogic();
					$logic->export($entryFilter, $entries);
				});
		
		$date = new \DateTime();
		$response->setStatusCode(200);
		$response->headers->set('Content-Type', 'text/html; charset=utf-8');
		$response->headers->set('Content-Disposition', 
				'attachment; filename="' . $date->format('Y-m-d') . '-benchmark.html"');
		
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
		$response->setCallback(
				function () use (&$entryFilter, &$entries) {
					$logic = new ExcelExportLogic();
					$logic->export($entryFilter, $entries);
				});
		
		$date = new \DateTime();
		$response->setStatusCode(200);
		$response->headers->set('Content-Type', 
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		$response->headers->set('Content-Disposition', 
				'attachment; filename="' . $date->format('Y-m-d') . '-benchmark.xlsx"');
		
		return $response;
	}
	
	// ---------------------------------------------------------------------------
	// Forms
	// ---------------------------------------------------------------------------
	protected function initIndexForms(Request $request, array &$params) {
		$response = parent::initIndexForms($request, $params);
		if ($response) {
			return $response;
		}
		
		$response = $this->initCategoryForm($request, $params);
		if ($response) {
			return $response;
		}
		
		$response = $this->initSubcategoryForm($request, $params);
		if ($response) {
			return $response;
		}
		
		$response = $this->initFilterForm($request, $params);
		if ($response) {
			return $response;
		}
		
		return null;
	}

	protected function initCompareForms(Request $request, array &$params) {
		return $this->initForms($request, $params);
	}
	
	protected function initCategoryForm(Request $request, array &$params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		// TODO should be taken from params??
		$category = $contextParams['category'];
		$filter = new CategoryFilter();
		$filter->setCategory($category);
		
		$optionsProvider = $this->getCategoryFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm(CategoryFilterType::class, $filter, $options);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			if ($form->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getRequestValues());
			}
		}
		
		$viewParams['categoryFilterForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}

	protected function initSubcategoryForm(Request $request, array &$params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		// TODO should be taken from params??
		$subcategory = $contextParams['subcategory'];
		$filter = new SubcategoryFilter();
		$filter->setSubcategory($subcategory);
		
		$optionsProvider = $this->getSubcategoryFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm(SubcategoryFilterType::class, $filter, $options);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			if ($form->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getRequestValues());
			}
		}
		
		$viewParams['subcategoryFilterForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}

	protected function initFilterForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$contextParams = $params['contextParams'];
		$filter = $viewParams['entryFilter'];
		$subcategory = $contextParams['subcategory'];
		
		$optionsProvider = $this->getFilterFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm($this->getFilterFormType(), $filter, $options);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			if ($form->get('saveQuery')->isClicked()) {
				$params = $filter->getRequestValues();
				$params['name'] = $this->getBenchmarkQueryName($subcategory);
				return $this->redirectToRoute($this->getCreateQueryRoute(), 
						array_merge($contextParams, $params));
			}
			
			if ($form->get('search')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getRequestValues());
			}
			
			if ($form->get('clear')->isClicked()) {
				$filter->clearRequestValues();
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getRequestValues());
			}
		}
		
		$viewParams['filterForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	protected function getCategoryFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.benchmark.product_category');
	}

	protected function getSubcategoryFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.benchmark.product_subcategory');
	}

	protected function getFilterFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.benchmark.index.product');
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function getBenchmarkQueryName($subcategoryId) {
		$date = new \DateTime();
		
		/** @var BaseRepository $em */
		$repository = $this->getDoctrine()->getRepository(Category::class);
		/** @var Category $subcategory */
		$subcategory = $repository->find($subcategoryId);
		
		return $date->format('Y-m-d H:i ') . $subcategory->getDisplayName();
	}
	
	// ---------------------------------------------------------------------------
	// Parameters
	// ---------------------------------------------------------------------------
	protected function getIndexParams(Request $request, array $params, $page) {
		$params = $this->getParams($request, $params);
		
		$em = $this->getEntryParamsManager();
		$params = $em->getIndexParams($request, $params, $page);
		
		return $params;
	}

	protected function getShowParams(Request $request, array $params, $id, $category = null) {
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
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
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
		$benchmarkFieldsProvider = new BenchmarkFieldsProvider($translator);
		
		$benchmarkFieldDataBaseUtils = new BenchmarkFieldDataBaseUtils(); // TODO service
		$productRepository = $this->get(ProductRepository::class);
		$benchmarkMessageRepository = $this->get(BenchmarkMessageRepository::class);
		
		$showBenchmarkFieldFactory = new NoteBenchmarkFieldFactory($benchmarkFieldDataBaseUtils, 
				$productRepository);
		$showBenchmarkFieldsInitializer = new BenchmarkFieldsInitializer($showBenchmarkFieldFactory);
		
		$compareBenchmarkFieldFactory = $this->get(CompareBenchmarkFieldFactory::class);
		$compareBenchmarkFieldsInitializer = new BenchmarkFieldsInitializer($compareBenchmarkFieldFactory);
		
		$distributionCalculator = $this->get(DistributionCalculator::class);
		$scoreDistributionCalculator = $this->get(ScoreDistributionCalculator::class);
		
		$neighboursFinder = $this->get(NeighboursFinder::class);
		
		return new ProductParamsManager($em, $fm, $tokenStorage, $productRepository, $benchmarkMessageRepository, 
				$benchmarkFieldsProvider, $showBenchmarkFieldsInitializer, $compareBenchmarkFieldsInitializer, 
				$distributionCalculator, $scoreDistributionCalculator, $neighboursFinder);
	}

	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(ProductManager::class);
	}

	protected function getFilterManager($doctrine) {
		$em = $doctrine->getManager();
		
		$translator = $this->get('translator');
		
		$benchmarkFieldsProvider = new BenchmarkFieldsProvider($translator);
		
		$showFieldFactory = $this->get(SimpleBenchmarkFieldFactory::class);
		$showFieldsInitializer = new BenchmarkFieldsInitializer($showFieldFactory);
		
		$filterFieldFactory = $this->get(FilterBenchmarkFieldFactory::class);
		$filterFieldsInitializer = new BenchmarkFieldsInitializer($filterFieldFactory);
		
		$categoryRepository = $this->get(CategoryRepository::class);
		
		return new FilterManager(
				new ProductFilter($benchmarkFieldsProvider, $showFieldsInitializer, $filterFieldsInitializer, 
						$categoryRepository));
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function getFilterFormType() {
		return ProductFilterType::class;
	}

	protected function getEntityType() {
		return Product::class;
	}
	
	// ---------------------------------------------------------------------------
	// Roles
	// ---------------------------------------------------------------------------
	protected function getCompareRole() {
		return $this->getShowRole();
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

	protected function getCompareView() {
		return $this->getDomain() . '/' . $this->getEntityName() . '/compare.html.twig';
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

	protected function getCompareRoute() {
		return $this->getIndexRoute() . '_compare';
	}

	protected function getCreateQueryRoute() {
		return $this->getDomain() . '_' . ClassUtils::getUnderscoreName(BenchmarkQuery::class) . '_new';
	}
}
