<?php

namespace AppBundle\Controller\Admin\Main;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Route\RouteManager;
use AppBundle\Manager\Params\Admin\ContextParamsManager;
use AppBundle\Manager\Analytics\AnalyticsManager;

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
	 * @param integer $page
	 *        	current page number
	 *        	
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function indexActionInternal(Request $request, $page) {
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		$viewParams = $params['viewParams'];
		
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
		$params['contextParams'] = array();
		$params['routeParams'] = array();
		$params['viewParams'] = array();
		
		return $params;
	}

	protected function getParams(Request $request, array $params) {
		$cpm = $this->getContextParamsManager($request);
		$params = $cpm->getParams($request, $params);
		
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
		$doctrine = $this->getDoctrine();
		
		$rm = new RouteManager();
		$lastRoute = $rm->getLastRoute($request, $this->getHomeRoute());
		$lastRouteParams = $lastRoute['routeParams'];
		
		if (! $lastRouteParams) {
			$lastRouteParams = array();
		}
		
		return new ContextParamsManager($doctrine, $lastRouteParams);
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
		return $this->getDomain() . '/admin/index.html.twig';
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getIndexRoute() {
		return $this->getDomain() . '_admin';
	}

	protected function getHomeRoute() {
		return array('route' => $this->getIndexView(), 'routeParams' => array());
	}

	protected function getDomain() {
		return 'admin';
	}
}
