<?php

namespace AppBundle\Controller\Infoprodukt\Base;

use AppBundle\Controller\Base\StandardController;
use AppBundle\Entity\Main\Advert;
use AppBundle\Entity\Main\NewsletterGroup;
use AppBundle\Entity\Main\NewsletterUser;
use AppBundle\Entity\Assignments\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Entity\Main\Page;
use AppBundle\Filter\Common\Search\SearchFilter;
use AppBundle\Form\Base\SearchFilterType;
use AppBundle\Form\Editor\Admin\Main\NewsletterUserEditorType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Manager\Params\EntryParams\Infoprodukt\Base\EntryParamsManager;
use AppBundle\Manager\Params\Infoprodukt\ContextParamsManager;
use AppBundle\Manager\Params\Infoprodukt\MenuParamsManager;
use AppBundle\Manager\Route\RouteManager;
use AppBundle\Repository\Infoprodukt\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class InfoproduktController extends StandardController {
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request        	
	 * @param integer $page
	 *        	current page number
	 *        	
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function indexActionInternal(Request $request, $page) {
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		$response = $this->initIndexForms($request, $params);
		if ($response)
			return $response;
		
		$viewParams = $params['viewParams'];
		
		return $this->render($this->getIndexView(), $viewParams);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id
	 *        	current entry ID
	 *        	
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function showActionInternal(Request $request, $id) {
		$params = $this->createParams($this->getShowRoute());
		$params = $this->getShowParams($request, $params, $id);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		$am->sendEventAnalytics($this->getEntityName(), 'show', $id);
		
		$response = $this->initShowForms($request, $params);
		if ($response)
			return $response;
		
		$viewParams = $params['viewParams'];
		
		return $this->render($this->getShowView(), $viewParams);
	}
	
	// ---------------------------------------------------------------------------
	// Actions blocks
	// ---------------------------------------------------------------------------
	protected function initIndexForms(Request $request, array &$params) {
		return $this->initForms($request, $params);
	}

	protected function initShowForms(Request $request, array &$params) {
		return $this->initForms($request, $params);
	}

	protected function initForms(Request $request, array &$params) {
		$response = $this->initSearchForm($request, $params);
		if ($response)
			return $response;
		
		$response = $this->initNewsletterForm($request, $params);
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

	protected function initNewsletterForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		
		$newsletter = new NewsletterUser();
		
		$newsletterForm = $this->createForm(NewsletterUserEditorType::class, $newsletter);
		$newsletterForm->handleRequest($request);
		
		if ($newsletterForm->isSubmitted() && $newsletterForm->isValid()) {
			if ($newsletterForm->get('save')->isClicked()) {
				$this->subscribe($newsletter);
			}
		}
		
		$viewParams['newsletterForm'] = $newsletterForm->createView();
		
		$params['viewParams'] = $viewParams;
		
		return null;
	}
	
	// ---------------------------------------------------------------------------
	// Parameters
	// ---------------------------------------------------------------------------
	protected function getParams(Request $request, array $params) {
		$params = parent::getParams($request, $params);
		
		$cpm = $this->getContextParamsManager($request);
		$params = $cpm->getParams($request, $params);
		
		$apm = $this->getAdvertParamsManager();
		$params = $apm->getParams($request, $params);
		
		$fpm = $this->getMenuParamsManager();
		$params = $fpm->getParams($request, $params);
		
		return $params;
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getContextParamsManager(Request $request) {
		$rm = new RouteManager();
		$lastRoute = $rm->getLastRoute($request, $this->getHomeRoute());
		$lastRouteParams = $lastRoute['routeParams'];
		
		if (! $lastRouteParams) {
			$lastRouteParams = array ();
		}
		
		$categoryRepository = $this->get(CategoryRepository::class);
		
		$paramManager = $this->get(ParamsManager::class);
		
		return new ContextParamsManager($categoryRepository, $paramManager, $lastRouteParams);
	}

	protected function getAdvertParamsManager() {
		return $this->get('app.manager.param.infoprodukt.advert.top-side');
	}

	protected function getMenuParamsManager() {
		return $this->get(MenuParamsManager::class);
	}

	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new EntryParamsManager($em, $fm, $doctrine);
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function subscribe($entry) {
		$em = $this->getDoctrine()->getManager();
		
		$repository = $this->getDoctrine()->getRepository(NewsletterUser::class);
		$persistent = $repository->findOneBy([ 'name' => $entry->getName() 
		]);
		
		if ($persistent) {
			if (! $persistent->getSubscribed()) {
				$persistent->setSubscribed(true);
				
				$em->persist($persistent);
				$em->flush();
			}
		} else {
			$entry->setInfoprodukt(true);
			$entry->setSubscribed(true);
			
			$em->persist($entry);
			$em->flush();
			
			$group = $em->getReference(NewsletterGroup::class, NewsletterGroup::INFOPRODUKT_GROUP);
			
			$groupAssignment = new NewsletterUserNewsletterGroupAssignment();
			$groupAssignment->setNewsletterUser($entry);
			$groupAssignment->setNewsletterGroup($group);
			
			$em->persist($groupAssignment);
			$em->flush();
		}
		
		$translator = $this->get('translator');
		$message = $translator->trans('success.subscribed');
		$message = str_replace('%mail%', '<b>' . $entry->getName() . '</b>', $message);
		$this->addFlash('success', $message);
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getHomeRoute() {
		return array ('route' => $this->getIndexView(),'routeParams' => array () 
		);
	}

	protected function getSearchRoute() {
		return $this->getDomain() . "_search";
	}
	
	// ---------------------------------------------------------------------------
	// Domain
	// ---------------------------------------------------------------------------
	protected function getDomain() {
		return 'infoprodukt';
	}
}
