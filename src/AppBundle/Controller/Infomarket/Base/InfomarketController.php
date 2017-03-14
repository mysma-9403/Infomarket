<?php

namespace AppBundle\Controller\Infomarket\Base;

use AppBundle\AppBundle;
use AppBundle\Controller\Base\StandardController;
use AppBundle\Entity\Advert;
use AppBundle\Entity\NewsletterUser;
use AppBundle\Filter\Common\SearchFilter;
use AppBundle\Form\Base\SearchFilterType;
use AppBundle\Form\Editor\Main\NewsletterUserEditorType;
use AppBundle\Manager\Params\Infomarket\AdvertParamsManager;
use AppBundle\Manager\Params\Infomarket\ContextParamsManager;
use AppBundle\Manager\Params\Infomarket\MenuParamsManager;
use AppBundle\Manager\Route\RouteManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\NewsletterGroup;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infomarket\Base\EntryParamsManager;

abstract class InfomarketController extends StandardController
{
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request
	 * @param integer $page current page number
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function indexActionInternal(Request $request, $page)
	{
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
	
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
	
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
	
		
		$viewParams = $params['viewParams'];
	
		$response = $this->initIndexForms($request, $viewParams);
		if($response) return $response;
		
		return $this->render($this->getIndexView(), $viewParams);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id current entry ID
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function showActionInternal(Request $request, $id)
	{
		$params = $this->createParams($this->getShowRoute());
		$params = $this->getShowParams($request, $params, $id);
	
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
	
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		$am->sendEventAnalytics($this->getEntityName(), 'show', $id);
	
	
		$viewParams = $params['viewParams'];
	
		$response = $this->initShowForms($request, $viewParams);
		if($response) return $response;
		
	
		return $this->render($this->getShowView(), $viewParams);
	}
	
	//---------------------------------------------------------------------------
	// Actions blocks
	//---------------------------------------------------------------------------
	
	protected function initIndexForms(Request $request, array &$viewParams) {
		return $this->initForms($request, $viewParams);
	}
	
	protected function initShowForms(Request $request, array &$viewParams) {
		return $this->initForms($request, $viewParams);
	}
	
	protected function initForms(Request $request, array &$viewParams) {
		$response = $this->initSearchForm($request, $viewParams);
		if($response) return $response;
	
		$response = $this->initNewsletterForm($request, $viewParams);
		if($response) return $response;
	
		return null;
	}
	
	protected function initSearchForm(Request $request, array &$viewParams) {
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
	
		return null;
	}
	
	protected function initNewsletterForm(Request $request, array &$viewParams) {
		$newsletter = new NewsletterUser();
	
		$newsletterForm = $this->createForm(NewsletterUserEditorType::class, $newsletter);
		$newsletterForm->handleRequest($request);
	
		if ($newsletterForm->isSubmitted() && $newsletterForm->isValid()) {
			if ($newsletterForm->get('save')->isClicked()) {
				$this->subscribe($newsletter);
			}
		}
	
		$viewParams['newsletterForm'] = $newsletterForm->createView();
		
		return null;
	}
	
	//---------------------------------------------------------------------------
	// Parameters
	//---------------------------------------------------------------------------
	
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
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getContextParamsManager(Request $request) {
		$doctrine = $this->getDoctrine();
	
		$rm = new RouteManager();
		$lastRoute = $rm->getLastRoute($request, $this->getHomeRoute());
		$lastRouteParams = $lastRoute['routeParams'];
		
		if(!$lastRouteParams) {
			$lastRouteParams = array();
		}
	
		return new ContextParamsManager($doctrine, $lastRouteParams);
	}
	
	protected function getAdvertParamsManager() {
		$doctrine = $this->getDoctrine();
		$advertLocations = [Advert::TOP_LOCATION, Advert::SIDE_LOCATION];
	
		return new AdvertParamsManager($doctrine, $advertLocations);
	}
	
	protected function getMenuParamsManager() {
		$doctrine = $this->getDoctrine();
		
		return new MenuParamsManager($doctrine);
	}
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new EntryParamsManager($em, $fm, $doctrine);
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	protected function subscribe($entry) {
		/** @var ObjectManager $em */
		$em = $this->getDoctrine()->getManager();
	
		$repository = $this->getDoctrine()->getRepository(NewsletterUser::class);
		$persistent = $repository->findOneBy(['name' => $entry->getName()]);
	
		if($persistent) {
			if(!$persistent->getSubscribed()) {
				$persistent->setSubscribed(true);
	
				$em->persist($persistent);
				$em->flush();
			}
		} else {
			$entry->setInfomarket(true);
			$entry->setSubscribed(true);
	
			$em->persist($entry);
			$em->flush();
			
			$group = $em->getReference(NewsletterGroup::class, NewsletterGroup::INFOMARKET_GROUP);
			
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
	
    //---------------------------------------------------------------------------
    // Routes
    //---------------------------------------------------------------------------
    
    protected function getHomeRoute() {
    	return array('route' => $this->getIndexView(), 'routeParams' => array());
    }
    
    protected function getSearchRoute()
    {
    	return $this->getDomain() . "_search";
    }
	
    //---------------------------------------------------------------------------
    // Domain
    //---------------------------------------------------------------------------
    protected function getDomain() {
    	return 'infomarket';
    }
}
