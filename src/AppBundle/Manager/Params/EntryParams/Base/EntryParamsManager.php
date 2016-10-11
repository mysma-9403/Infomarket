<?php

namespace AppBundle\Manager\Params\EntryParams\Base;

use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Base\ParamsManager;

class EntryParamsManager extends ParamsManager {
	
	/** @var EntityManager */
	protected $em;
	
	/** @var FilterManager */
	protected $fm;
	
	/**
	 * 
	 * @param EntityManager $entityManager
	 * @param unknown $doctrine
	 */
	public function __construct(EntityManager $em, FilterManager $fm, $doctrine) {
		parent::__construct($doctrine);
		
		$this->em = $em;
		$this->fm = $fm;
	}
	
	public function getIndexParams(Request $request, array $params, $page) {
		$viewParams = $params['viewParams'];
		$routeParams = $params['routeParams'];
	
		
		$filter = $this->fm->createFromRequest($request, $params);
		$routeParams = array_merge($routeParams, $filter->getValues()); //TODO getValues -> getParams?
		$routeParams['page'] = $page;
		
		$filter = $this->fm->adaptToView($filter, $params);
		$viewParams['entryFilter'] = $filter;
	
		$entries = $this->em->getEntries($filter, $page);
		$viewParams['entries'] = $entries;
	
	
		$params['viewParams'] = $viewParams;
		$params['routeParams'] = $routeParams;
		return $params;
	}
	
	public function getShowParams(Request $request, array $params, $id) {
		$viewParams = $params['viewParams'];
		$routeParams = $params['routeParams'];
		
		$routeParams['id'] = $id;
		
		$entry = $this->em->getEntry($id);
		$viewParams['entry'] = $entry;
		
		$params['viewParams'] = $viewParams;
		$params['routeParams'] = $routeParams;
    	return $params;
	}
	
	public function getNewParams(Request $request, array $params) {
		$viewParams = $params['viewParams'];
	
		$entry = $this->em->createFromRequest($request);
		$viewParams['entry'] = $entry;
	
		$params['viewParams'] = $viewParams;
		return $params;
	}
	
	public function getCopyParams(Request $request, array $params, $id) {
		$viewParams = $params['viewParams'];
		$routeParams = $params['routeParams'];
		
		$routeParams['id'] = $id;
		
		$template = $this->em->getEntry($id);
		$entry = $this->em->createFromTemplate($template);
		$viewParams['entry'] = $entry;
		
		$params['viewParams'] = $viewParams;
		$params['routeParams'] = $routeParams;
    	return $params;
	}
	
	public function getEditParams(Request $request, array $params, $id) {
		return $this->getShowParams($request, $params, $id);
	}
}