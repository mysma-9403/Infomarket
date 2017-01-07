<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\InfomarketController;
use AppBundle\Entity\Article;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\NewsletterUser;
use AppBundle\Form\Editor\NewsletterUserEditorType;
use AppBundle\Form\Filter\Infomarket\ArticleFilterType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Common\ArticleManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Filter\Infomarket\IMArticleFilterManager;
use AppBundle\Manager\Params\EntryParams\Infomarket\IMArticleEntryParamsManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends InfomarketController
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
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function showAction(Request $request, $id, $page)
	{
		return $this->previewActionInternal($request, $id, $page);
	}
	
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
	
	
	
	
		// 		$userRepository = $this->getDoctrine()->getRepository(User::class);
	
		// 		$searchFilter = new SimpleEntityFilter($userRepository);
		// 		$searchFilter->initValues($request);
	
		// 		$searchFilterForm = $this->createForm(SimpleEntityFilterType::class, $searchFilter);
		// 		$searchFilterForm->handleRequest($request);
	
		// 		if ($searchFilterForm->isSubmitted() && $searchFilterForm->isValid()) {
		// 			if ($searchFilterForm->get('search')->isClicked()) {
		// 				return $this->redirectToRoute($this->getSearchRoute(), $searchFilter->getValues());
		// 			}
		// 		}
		// 		$viewParams['searchFilterForm'] = $searchFilterForm->createView();
	
	
	
		$newsletter = new NewsletterUser();
	
		$newsletterForm = $this->createForm(NewsletterUserEditorType::class, $newsletter);
		$newsletterForm->handleRequest($request);
	
		if ($newsletterForm->isSubmitted() && $newsletterForm->isValid()) {
			if ($newsletterForm->get('save')->isClicked()) {
				$this->subscribe($newsletter);
			}
		}
		$viewParams['newsletterForm'] = $newsletterForm->createView();
	
	
	
		$articleFilter = $viewParams['entryFilter'];
		
		$articleFilterForm = $this->createForm(ArticleFilterType::class, $articleFilter);
		$articleFilterForm->handleRequest($request);
		
		if ($articleFilterForm->isSubmitted() && $articleFilterForm->isValid()) {
		
			if ($articleFilterForm->get('search')->isClicked()) {
				$articleFilter->setPublished(BaseEntityFilter::ALL_VALUES);
				$articleFilter->setMain(BaseEntityFilter::ALL_VALUES);
				$articleFilter->setCategories(array());
		
				$routingParams = array();
				$routingParams = array_merge($routingParams, $articleFilter->getValues());
		
				return $this->redirectToRoute($this->getIndexRoute(), $routingParams);
			}
		
			if ($articleFilterForm->get('clear')->isClicked()) {
				$routingParams = array();
		
				return $this->redirectToRoute($this->getIndexRoute(), $routingParams);
			}
		}
		$viewParams['articleFilterForm'] = $articleFilterForm->createView();
		$viewParams['tags'] = $articleFilter->getTags();
		
		
		
		return $this->render($this->getIndexView(), $viewParams);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id current entry ID
	 * @param integer $page page of current entry
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function previewActionInternal(Request $request, $id, $page)
	{
		$params = $this->createParams($this->getShowRoute());
		$params = $this->getPreviewParams($request, $params, $id, $page);
	
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
	
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		$am->sendEventAnalytics($this->getEntityName(), 'show', $id);
	
	
		$viewParams = $params['viewParams'];
	
	
	
		// 		$userRepository = $this->getDoctrine()->getRepository(User::class);
	
		// 		$searchFilter = new SimpleEntityFilter($userRepository);
		// 		$searchFilter->initValues($request);
	
		// 		$searchFilterForm = $this->createForm(SearchFilterType::class, $searchFilter);
		// 		$searchFilterForm->handleRequest($request);
	
		// 		if ($searchFilterForm->isSubmitted() && $searchFilterForm->isValid()) {
		// 			if ($searchFilterForm->get('search')->isClicked()) {
		// 				return $this->redirectToRoute($this->getSearchRoute(), $searchFilter->getValues());
		// 			}
		// 		}
		// 		$viewParams['searchFilterForm'] = $searchFilterForm->createView();
	
	
	
		$newsletter = new NewsletterUser();
	
		$newsletterForm = $this->createForm(NewsletterUserEditorType::class, $newsletter);
		$newsletterForm->handleRequest($request);
	
		if ($newsletterForm->isSubmitted() && $newsletterForm->isValid()) {
			if ($newsletterForm->get('save')->isClicked()) {
				$this->subscribe($newsletter);
			}
		}
		$viewParams['newsletterForm'] = $newsletterForm->createView();
	
	
	
		return $this->render($this->getShowView(), $viewParams);
	}
	
	/**
	 *
	 * @param array $params
	 * @return array
	 */
	protected function getPreviewParams(Request $request, array $params, $id, $page) {
		$params = $this->getParams($request, $params);
	
		$em = $this->getEntryParamsManager();
		$params = $em->getPreviewParams($request, $params, $id, $page);
	
		return $params;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new IMArticleEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		$tokenStorage = $this->get('security.token_storage');
		return new ArticleManager($doctrine, $paginator, $tokenStorage);
	}
	
	protected function getEntryFilterManager($doctrine) {
		return new IMArticleFilterManager($doctrine);
	}
	
	protected function isFilterByCategories() {
		return true;
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
    	return Article::class;
    }
}
