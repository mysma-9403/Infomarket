<?php

namespace AppBundle\Controller\Benchmark\Base;

use AppBundle\AppBundle;
use AppBundle\Controller\Admin\Base\AdminController;
use AppBundle\Entity\Lists\BaseList;
use AppBundle\Filter\Common\Search\SearchFilter;
use AppBundle\Form\Base\SearchFilterType;
use AppBundle\Form\Lists\Base\BaseListType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;

abstract class BenchmarkAdminController extends AdminController {
	
	// ---------------------------------------------------------------------------
	// Actions blocks
	// ---------------------------------------------------------------------------
	protected function initForms(Request $request, array &$params) {
		$response = parent::initForms($request, $params);
		if ($response)
			return $response;
		
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
	// Form options
	// ---------------------------------------------------------------------------
	protected function getListFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.list');
	}

	protected function getFilterFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.base');
	}

	protected function getEditorFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.base');
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
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function createNewList() {
		return new BaseList();
	}

	protected function getListFormType() {
		return BaseListType::class;
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
