<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\InfomarketController;
use AppBundle\Entity\Main\Magazine;
use AppBundle\Filter\Infomarket\Base\BranchDependentFilter;
use AppBundle\Manager\Entity\Infomarket\MagazineManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MagazineController extends InfomarketController {
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	/**
	 *
	 * @param Request $request        	
	 * @param integer $page        	
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}

	public function openAction(Request $request, $id) {
		return $this->openActionInternal($request, $id);
	}
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	protected function openActionInternal(Request $request, $id) {
		$params = $this->createParams($this->getOpenRoute());
		$params = $this->getShowParams($request, $params, $id);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		$am->sendEventAnalytics($this->getEntityName(), 'open', $id);
		
		$viewParams = $params['viewParams'];
		
		$entry = $viewParams['entry'];
		
		return $this->redirect($entry->getMagazineFile());
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(MagazineManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new BranchDependentFilter());
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getOpenRoute() {
		return $this->getIndexRoute() . '_open';
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Controller\Infomarket\Base\SimpleController::getEntityType()
	 */
	protected function getEntityType() {
		return Magazine::class;
	}
}