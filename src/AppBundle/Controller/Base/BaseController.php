<?php

namespace AppBundle\Controller\Base;

use AppBundle\Manager\Analytics\AnalyticsManager;
use AppBundle\Manager\Route\RouteManager;
use AppBundle\Utils\ClassUtils;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseController extends Controller
{
	//---------------------------------------------------------------------------
	// Params
	//---------------------------------------------------------------------------
	/**
	 * 
	 * @param array $params
	 * @return array
	 */
	protected function getParams(Request $request, array $params) {
		return $params;
	}
	
	/**
	 * 
	 * @param string $route
	 * @return array
	 */
	protected function createParams($route) {
		$params = array();
		
		$params['domain'] = $this->getDomain();
		$params['route'] = $route;
		$params['routeParams'] = array();
		$params['viewParams'] = array();
		
		return $params;
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getEntry($id) {
		$repository = $this->getEntityRepository();
		$entry = $repository->find($id);
	
		return $entry;
	}
	
	protected function redirectToReferer(Request $request) {
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	/**
	 * 
	 * @return \AppBundle\Manager\Route\Base\RouteManager
	 */
	protected function getRouteManager() {
		return new RouteManager();
	}
	
	protected function getAnalyticsManager() {
		$tracker = $this->get('happyr.google_analytics.tracker');
		return new AnalyticsManager($tracker, 1);
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
    /**
     * 
     * @return ObjectRepository
     */
    protected function getEntityRepository()
    {
    	return $this->getDoctrine()->getRepository($this->getEntityType());
    }
    
    /**
     * @return string
     */
    protected function getEntityName()
    {
    	return ClassUtils::getClassName($this->getEntityType());
    }
    
    /**
     * @return class
     */
    protected abstract function getEntityType();
    
    //---------------------------------------------------------------------------
    // Domain
    //---------------------------------------------------------------------------
    /**
     * @return string domain - base part of the route
     */
    protected abstract function getDomain();
}
