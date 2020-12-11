<?php

namespace AppBundle\Controller\Base;

use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Filter\Base\Filter;

abstract class StandardController extends DummyController {
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Controller\Base\BaseController::indexActionInternal()
	 */
	protected function indexActionInternal(Request $request, $page) {
		if ($this->getShowRole() != 'ROLE_GUEST') {
			$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		}
		
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		$response = $this->initIndexForms($request, $params);
		if ($response)
			return $response;
		
		$routeParams = $params['routeParams'];
		
		$viewParams = $params['viewParams'];
		$viewParams['routeParams'] = $routeParams;
		
		return $this->render($this->getIndexView(), $viewParams);
	}

	protected function showActionInternal(Request $request, $id) {
		if ($this->getShowRole() != 'ROLE_GUEST') {
			$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		}
		
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
	// Actions blocks
	// ---------------------------------------------------------------------------
	protected function initIndexForms(Request $request, array &$params) {
		return $this->initForms($request, $params);
	}

	protected function initShowForms(Request $request, array &$params) {
		return $this->initForms($request, $params);
	}

	protected function initForms(Request $request, array &$params) {
		return null;
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @param array $params        	
	 * @return array
	 */
	protected function getIndexParams(Request $request, array $params, $page) {
		$params = $this->getParams($request, $params);
		$em = $this->getEntryParamsManager();
		$params = $em->getIndexParams($request, $params, $page);
        $params['domain'] = 'infoprodukt';
		
		return $params;
	}

	/**
	 *
	 * @param array $params        	
	 * @return array
	 */
	protected function getShowParams(Request $request, array $params, $id, $category = null) {
		$params = $this->getParams($request, $params);
		$em = $this->getEntryParamsManager();
		$params['category_url'] = $category;
		$params = $em->getShowParams($request, $params, $id);
		
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
		return new EntryParamsManager($em, $fm, $doctrine);
	}

	protected abstract function getEntityManager($doctrine, $paginator);

	protected function getFilterManager($doctrine) {
		return new FilterManager(new Filter());
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
	protected function getShowRoute() {
		return $this->getIndexRoute() . '_show';
	}

	protected function getIndexRoute() {
		return $this->getDomain() . '_' . $this->getEntityName();
	}
	
	// ---------------------------------------------------------------------------
	// Roles
	// ---------------------------------------------------------------------------
	protected function getShowRole() {
		return 'ROLE_USER';
	}
}
