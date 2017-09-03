<?php

namespace AppBundle\Controller\Base;

use AppBundle\Factory\Common\Message\LifecycleMessageFactory;
use AppBundle\Manager\Analytics\AnalyticsManager;
use AppBundle\Manager\Route\RouteManager;
use AppBundle\Utils\ClassUtils;
use AppBundle\Utils\ParamUtils;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Factory\Common\Choices\Base\ChoicesFactory;

abstract class DummyController extends Controller {
	// ---------------------------------------------------------------------------
	// Params
	// ---------------------------------------------------------------------------
	
	/**
	 * Extends params collection by the request attributes.
	 *
	 * @param array $params
	 *        	params collection
	 *        	
	 * @return array params collection
	 */
	protected function getParams(Request $request, array $params) {
		return $params;
	}

	/**
	 * Creates dummy params which can be initialized further by getParams method.
	 *
	 * @param string $route        	
	 *
	 * @return array dummy params collection
	 */
	protected function createParams($route) {
		$params = array ();
		
		$params['domain'] = $this->getDomain();
		$params['route'] = $route;
		$params['contextParams'] = array ();
		$params['routeParams'] = array ();
		$params['viewParams'] = array ();
		
		return $params;
	}
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	protected function addFactoryChoicesFormOption(&$options, $class, $name) {
		/** @var ChoicesFactory $choicesFactory */
		$choicesFactory = $this->get($class);
		$choices = $choicesFactory->getItems();
		
		$this->addChoicesFormOption($options, $choices, $name);
	}

	protected function addEntityChoicesFormOption(&$options, $class, $name) {
		/** @var BaseRepository $repository */
		$repository = $this->getDoctrine()->getRepository($class);
		$choices = $repository->findFilterItems();
		
		$this->addChoicesFormOption($options, $choices, $name);
	}

	protected function addChoicesFormOption(&$options, $choices, $name) {
		$options[ParamUtils::getChoicesName($name)] = $choices;
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	
	/**
	 * Returns entry found in repository by specified id.
	 *
	 * @param integer $id        	
	 *
	 * @return object repository entry
	 */
	protected function getEntry($id) {
		$repository = $this->getEntityRepository();
		$entry = $repository->find($id);
		
		return $entry;
	}

	/**
	 * Redirects to referer (e.g.
	 * last shown page).
	 *
	 * @param Request $request        	
	 *
	 * @return RedirectResponse referer
	 */
	protected function redirectToReferer(Request $request) {
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @return \AppBundle\Manager\Route\Base\RouteManager
	 */
	protected function getRouteManager() {
		return new RouteManager();
	}

	/**
	 */
	protected function getAnalyticsManager() {
		$tracker = $this->get('happyr.google_analytics.tracker');
		return new AnalyticsManager($tracker, 1);
	}
	
	// ---------------------------------------------------------------------------
	// Messages
	// ---------------------------------------------------------------------------
	protected function flashCreatedMessage() {
		/** @var LifecycleMessageFactory $classMessageFactory */
		$classMessageFactory = $this->get(LifecycleMessageFactory::class);
		$message = $classMessageFactory->getMessage('success.created', $this->getEntityType());
		$this->addFlash('success', $message);
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @return ObjectRepository
	 */
	protected function getEntityRepository() {
		return $this->getDoctrine()->getRepository($this->getEntityType());
	}

	/**
	 *
	 * @return string
	 */
	protected function getEntityName() {
		return ClassUtils::getUnderscoreName($this->getEntityType());
	}

	/**
	 *
	 * @return class
	 */
	protected abstract function getEntityType();
	
	// ---------------------------------------------------------------------------
	// Domain
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @return string domain - base part of the route
	 */
	protected abstract function getDomain();
}
