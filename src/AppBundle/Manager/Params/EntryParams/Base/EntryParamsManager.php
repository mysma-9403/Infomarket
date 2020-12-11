<?php

namespace AppBundle\Manager\Params\EntryParams\Base;

use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;

class EntryParamsManager {

	/** @var EntityManager */
	protected $em;

	/** @var FilterManager */
	protected $fm;

	/**
	 *
	 * @param EntityManager $entityManager        	
	 * @param unknown $doctrine        	
	 */
	public function __construct(EntityManager $em, FilterManager $fm) {
		$this->em = $em;
		$this->fm = $fm;
	}

	public function getIndexParams(Request $request, array $params, $page) {
		$viewParams = $params['viewParams'];
		$routeParams = $params['routeParams'];
		$contextParams = $params['contextParams'];
		
		$filter = $this->fm->createFromRequest($request, $contextParams);
		$viewParams['entryFilter'] = $filter;
		
		$entries = $this->em->getEntries($filter, $page);
		$viewParams['entries'] = $entries;
		
		$routeParams = array_merge($routeParams, $filter->getRequestValues()); // TODO getValues -> getParams?
		$routeParams['page'] = $page;
		
		$params['viewParams'] = $viewParams;
		$params['routeParams'] = $routeParams;
		return $params;
	}

	public function getShowParams(Request $request, array $params, $id, $category = null) {
		$viewParams = $params['viewParams'];
		$routeParams = $params['routeParams'];
		$routeParams['id'] = $id;

		$category = isset($params['category_url']) ? $params['category_url'] : null;
		if (is_string($id)) {
		    if ($category) {
		        if ((int) $category !== 0) {
                    $entry = $this->em->getEntry($category);
                } else {
                    $entry = $this->em->getEntry(['slugUrl' => $category]);
                }
            } else {
                if ((int) $category !== 0) {
                    $entry = $this->em->getEntry($id);
                } else {
                    $entry = $this->em->getEntry(['slugUrl' => $id]);
                }
            }
        } else {
            $entry = $this->em->getEntry($id);
        }
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
		$viewParams['template'] = $template;
		$viewParams['entry'] = $entry;
		
		$params['viewParams'] = $viewParams;
		$params['routeParams'] = $routeParams;
		return $params;
	}

	public function getEditParams(Request $request, array $params, $id) {
		return $this->getShowParams($request, $params, $id);
	}
}
