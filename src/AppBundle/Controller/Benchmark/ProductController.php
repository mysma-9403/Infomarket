<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Base\DummyController;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\CategoryFilter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Filter\Benchmark\SubcategoryFilter;
use AppBundle\Form\Benchmark\CategoryFilterType;
use AppBundle\Form\Benchmark\ProductFilterType;
use AppBundle\Form\Benchmark\SubcategoryFilterType;
use AppBundle\Logic\Benchmark\Export\CsvExportLogic;
use AppBundle\Logic\Benchmark\Export\ExcelExportLogic;
use AppBundle\Logic\Benchmark\Export\HtmlExportLogic;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Benchmark\ProductManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;
use AppBundle\Manager\Params\EntryParams\Benchmark\ProductParamsManager;
use AppBundle\Manager\Route\RouteManager;
use AppBundle\Repository\Benchmark\BenchmarkFieldRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Validator\Constraints\Date;
use AppBundle\Entity\BenchmarkQuery;
use AppBundle\Utils\StringUtils;

class ProductController extends DummyController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
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
		$tokenStorage = $this->get('security.token_storage');
		$user = $tokenStorage->getToken()->getUser()->getId();
		
		$category = $contextParams['category'];
		$categoryFilter = new CategoryFilter();
		$categoryFilter->setCategory($category);

		$categoryFilterForm = $this->createForm(CategoryFilterType::class, $categoryFilter, ['user' => $user]);
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
		
		$subcategoryFilterForm = $this->createForm(SubcategoryFilterType::class, $subcategoryFilter, ['user' => $user, 'category' => $category]);
		$subcategoryFilterForm->handleRequest($request);
		
		if ($subcategoryFilterForm->isSubmitted() && $subcategoryFilterForm->isValid()) {
			if ($subcategoryFilterForm->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $subcategoryFilter->getRequestValues());
			}
		}
		$viewParams['subcategoryFilter'] = $subcategoryFilterForm->createView();
		
		
		/** @var ProductFilter $filter */
		$filter = $viewParams['entryFilter'];
	
		$filterForm = $this->createForm($this->getFilterFormType(), $filter, ['user' => $user, 'category' => $subcategory, 'fields' => $filter->getFilterFields()]);
		$filterForm->handleRequest($request);
	
		if ($filterForm->isSubmitted() && $filterForm->isValid()) {
			
			if ($filterForm->get('saveQuery')->isClicked()) {
				return $this->redirectToRoute($this->getCreateQueryRoute(), array_merge($contextParams, $filter->getRequestValues()));
			}
			
			if ($filterForm->get('saveResults')->isClicked()) {
				//TODO 
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
		return new ProductParamsManager($em, $fm, $doctrine, $tokenStorage);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		$em = $doctrine->getManager();
		$repository = new ProductRepository($em, $em->getClassMetadata(Product::class));
		
		return new ProductManager($doctrine, $paginator, $repository);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getFilterManager()
	 */
	protected function getFilterManager($doctrine) {
		$em = $doctrine->getManager();
		$benchmarkFieldRepository = new BenchmarkFieldRepository($em, $em->getClassMetadata(BenchmarkField::class));
		
		return new FilterManager(new ProductFilter($benchmarkFieldRepository));
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
		return self::getShowRole();
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
	
	protected function getCreateQueryRoute()
	{
		return $this->getDomain() . '_' . StringUtils::getClassName(BenchmarkQuery::class) . '_new';
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