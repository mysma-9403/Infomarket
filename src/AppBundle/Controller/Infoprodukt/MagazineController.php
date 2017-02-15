<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\InfoproduktController;
use AppBundle\Entity\Magazine;
use AppBundle\Manager\Entity\Infoprodukt\MagazineManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MagazineController extends InfoproduktController
{   
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	/**
	 *
	 * @param Request $request
	 * @param integer $page
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	public function openAction(Request $request, $id)
	{
		return $this->openActionInternal($request, $id);
	}
	
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
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
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getEntityManager($doctrine, $paginator) {
		$em = new MagazineManager($doctrine, $paginator);
		$em->setEntriesPerPage(12);
		
		return $em;
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	protected function getOpenRoute()
	{
		return $this->getIndexRoute() . '_open';
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	/**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Infomarket\Base\SimpleEntityController::getEntityType()
     */
    protected function getEntityType()
    {
    	return Magazine::class;
    }
}
