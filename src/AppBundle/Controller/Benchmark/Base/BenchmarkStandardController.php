<?php

namespace AppBundle\Controller\Benchmark\Base;

use AppBundle\AppBundle;
use AppBundle\Controller\Base\StandardController;
use AppBundle\Filter\Common\Search\SearchFilter;
use AppBundle\Form\Base\SearchFilterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;

abstract class BenchmarkStandardController extends StandardController {
	
	// ---------------------------------------------------------------------------
	// Actions blocks
	// ---------------------------------------------------------------------------
	protected function initForms(Request $request, array &$params) {
		$response = $this->initSearchForm($request, $params);
		if ($response)
			return $response;
		
		return null;
	}

	protected function initSearchForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$searchFilter = new SearchFilter();
		$searchFilter->initRequestValues($request);
		
		$searchFilterForm = $this->createForm(SearchFilterType::class, $searchFilter);
		$searchFilterForm->handleRequest($request);
		
		if ($searchFilterForm->isSubmitted() && $searchFilterForm->isValid()) {
			if ($searchFilterForm->get('search')->isClicked()) {
				return $this->redirectToRoute($this->getSearchRoute(), $searchFilter->getRequestValues());
			}
		}
		
		$viewParams['menuSearchFilterForm'] = $searchFilterForm->createView();
		$viewParams['searchFilterForm'] = $searchFilterForm->createView();
		
		$params['viewParams'] = $viewParams;
		
		return null;
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
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getContextParamsManager(Request $request) {
		return $this->get(ContextParamsManager::class);
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getHomeRoute() {
		return array('route' => $this->getIndexView(), 'routeParams' => array());
	}

	protected function getSearchRoute() {
		return $this->getDomain() . "_search";
	}
	
	// ---------------------------------------------------------------------------
	// Domain
	// ---------------------------------------------------------------------------
	protected function getDomain() {
		return 'benchmark';
	}
}
