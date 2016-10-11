<?php

namespace AppBundle\Controller\Infomarket\Base;

use AppBundle\AppBundle;
use AppBundle\Controller\Base\BaseEntityController;
use AppBundle\Entity\Advert;
use AppBundle\Manager\Params\Base\AdvertParamsManager;
use AppBundle\Manager\Params\Base\FooterParamsManager;
use AppBundle\Manager\Params\Infomarket\InfomarketParamsManager;
use AppBundle\Manager\Route\RouteManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Filter\Infomarket\Base\InfomarketFilterManager;

abstract class InfomarketController extends BaseEntityController
{
	//---------------------------------------------------------------------------
	// Parameters
	//---------------------------------------------------------------------------
	
	protected function getParams(Request $request, array $params) {
		$params = parent::getParams($request, $params);
		
		$cpm = $this->getContextParamsManager($request);
		$params = $cpm->getParams($request, $params);
		
		$apm = $this->getAdvertParamsManager();
		$params = $apm->getParams($request, $params);
		
		$fpm = $this->getFooterParamsManager();
		$params = $fpm->getParams($request, $params);
		
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
	
		return new InfomarketParamsManager($doctrine, $lastRouteParams);
	}
	
	protected function getAdvertParamsManager() {
		$doctrine = $this->getDoctrine();
		$advertLocations = [Advert::TOP_LOCATION, Advert::SIDE_LOCATION];
	
		return new AdvertParamsManager($doctrine, $advertLocations);
	}
	
	protected function getFooterParamsManager() {
		$doctrine = $this->getDoctrine();
		
		return new FooterParamsManager($doctrine);
	}
    
	
	
	
	protected final function getFilterManager($doctrine) {
		$efm = $this->getEntryFilterManager($doctrine);
		$fm = new InfomarketFilterManager($efm);
	
		$fm->setFilterByBranches($this->isFilterByBranches());
		$fm->setFilterByCategories($this->isFilterByCategories());
	
		return $fm;
	}
	
	protected abstract function getEntryFilterManager($doctrine);
	
	
	
	protected function isFilterByBranches() {
		return false;
	}
	
	protected function isFilterByCategories() {
		return false;
	}
	
    //---------------------------------------------------------------------------
    // Routes
    //---------------------------------------------------------------------------
    protected function getHomeRoute() {
    	return array('route' => $this->getIndexView(), 'routeParams' => array());
    }
	
    //---------------------------------------------------------------------------
    // Domain
    //---------------------------------------------------------------------------
    protected function getDomain() {
    	return 'infomarket';
    }
}
