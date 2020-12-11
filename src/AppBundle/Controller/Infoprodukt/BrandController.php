<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\InfoproduktController;
use AppBundle\Entity\Main\Brand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Entity\Infoprodukt\BrandManager;

class BrandController extends InfoproduktController {
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
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(BrandManager::class);
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function getEntityType() {
		return Brand::class;
	}
}
