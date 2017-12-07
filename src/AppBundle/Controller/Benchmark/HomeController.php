<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Filter\Base\Filter;
use AppBundle\Manager\Analytics\AnalyticsManager;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Benchmark\CategoryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;
use AppBundle\Manager\Params\EntryParams\Benchmark\HomeEntryParamsManager;
use AppBundle\Manager\Route\RouteManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Benchmark\CategoryRepository;

class HomeController extends Controller {

	public function indexAction(Request $request) {
		return $this->indexActionInternal($request, 1);
	}
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request        	
	 * @param unknown $page        	
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function indexActionInternal(Request $request, $page) {
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		$routeParams = $params['routeParams'];
		
		$viewParams = $params['viewParams'];
		$viewParams['routeParams'] = $routeParams;
		
		return $this->render($this->getIndexView(), $viewParams);
	}
	
	// ---------------------------------------------------------------------------
	// Params
	// ---------------------------------------------------------------------------
	
	/**
	 * Creates dummy params which can be initialized further by getParams method.
	 *
	 * @param string $route        	
	 *
	 * @return array dummy params collection
	 */
	protected function createParams($route) {
		$params = array();
		
		$params['domain'] = $this->getDomain();
		$params['route'] = $route;
		$params['lastRouteParams'] = array();
		$params['contextParams'] = array();
		$params['routeParams'] = array();
		$params['viewParams'] = array();
		
		return $params;
	}
	
	protected function getParams(Request $request, array $params) {
		$cpm = $this->getContextParamsManager($request);
		$params = $cpm->getParams($request, $params);
		
		$epm = $this->getEntryParamsManager();
		$params = $epm->getIndexParams($request, $params, 1);
	
		$viewParams = $params['viewParams'];
		$viewParams['isAdmin'] = $this->isAdmin();
		$params['viewParams'] = $viewParams;
		
		return $params;
	}

	/**
	 *
	 * @param array $params        	
	 * @return array
	 */
	protected function getIndexParams(Request $request, array $params, $page) {
		$params = $this->getParams($request, $params);
		
		return $params;
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @return \AppBundle\Manager\Route\Base\RouteManager
	 */
	protected function getRouteManager() {
		return new RouteManager();
	}

	/**
	 */
	protected function getAnalyticsManager() {
		$tracker = $this->get('happyr.google_analytics.tracker');
		return new AnalyticsManager($tracker, 1);
	}

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
		return new HomeEntryParamsManager($em, $fm, $categoryRepository);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(CategoryManager::class);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new Filter());
	}
	
	// ---------------------------------------------------------------------------
	// Permissions
	// ---------------------------------------------------------------------------
	protected function isAdmin() {
		return $this->isGranted('ROLE_ADMIN');
	}
	
	// ---------------------------------------------------------------------------
	// Roles
	// ---------------------------------------------------------------------------
	protected function getShowRole() {
		return 'ROLE_USER';
	}
	
	// ---------------------------------------------------------------------------
	// Views
	// ---------------------------------------------------------------------------
	protected function getIndexView() {
		return $this->getDomain() . '/home/index.html.twig';
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getIndexRoute() {
		return $this->getDomain() . '_benchmark';
	}

	protected function getHomeRoute() {
		return array('route' => $this->getIndexView(), 'routeParams' => array());
	}

	protected function getDomain() {
		return 'benchmark';
	}
}
