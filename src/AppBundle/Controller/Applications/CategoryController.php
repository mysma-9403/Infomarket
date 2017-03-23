<?php

namespace AppBundle\Controller\Applications;

use AppBundle\Controller\Base\DummyController;
use AppBundle\Entity\Category;
use AppBundle\Repository\Applications\CategoryRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends DummyController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	public function indexAction(Request $request, $category) {
		return $this->indexActionInternal($request, $category);
	}
	
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::indexActionInternal()
	 */
	protected function indexActionInternal(Request $request, $category)
	{	
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $category);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		return new JsonResponse($params['items']);
	}
	
	//---------------------------------------------------------------------------
	// Parameters
	//---------------------------------------------------------------------------
	
	protected function getIndexParams(Request $request, array $params, $category) {
		$params = $this->getParams($request, $params);
	
		$em = $this->getDoctrine()->getManager();
		$repository = new CategoryRepository($em, $em->getClassMetadata($this->getEntityType()));
		$items = $repository->findItemsByCategory($category);
		$params['items'] = $items;
	
		return $params;
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	protected function getEntityType() {
		return Category::class;
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	protected function getIndexRoute()
	{
		return $this->getDomain() . '_' . $this->getEntityName();
	}
	
	protected function getHomeRoute() {
		return array('route' => $this->getIndexRoute(), 'routeParams' => array());
	}
	
	
	//---------------------------------------------------------------------------
	// Domain
	//---------------------------------------------------------------------------
	
	protected function getDomain() {
		return 'applications';
	}
}