<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\InfoproduktController;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Filter\Infoprodukt\Main\ArticleFilter;
use AppBundle\Form\Filter\Infoprodukt\ArticleFilterType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Infoprodukt\ArticleManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infoprodukt\ArticleEntryParamsManager;
use AppBundle\Repository\Infoprodukt\ArticleCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends InfoproduktController
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
	 * @param integer $id current entry ID
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
		
		$response = $this->initPreviewForms($request, $viewParams);
		if($response) return $response;
	
		
		return $this->render($this->getShowView(), $viewParams);
	}
	
	//---------------------------------------------------------------------------
	// Actions blocks
	//---------------------------------------------------------------------------
	
	protected function initPreviewForms(Request $request, array &$viewParams) {
		return $this->initShowForms($request, $viewParams);
	}
	
	protected function initIndexForms(Request $request, array &$viewParams) {
		$response = parent::initIndexForms($request, $viewParams);
		if($response) return $response;
		
		$response = $this->initFilterForm($request, $viewParams);
		if($response) return $response;
	
		return null;
	}
	
	protected function initFilterForm(Request $request, array &$viewParams) {
		/** @var Filter $itemFilter */
		$itemFilter = $viewParams['entryFilter'];
		
		$em = $this->getDoctrine()->getManager();
		
		/** @var ArticleCategoryRepository $articleCategoryRepository */
		$articleCategoryRepository = new ArticleCategoryRepository($em, $em->getClassMetadata(ArticleCategory::class));
		$articleCategories = $articleCategoryRepository->findFilterItems();
		
		$articleFilterForm = $this->createForm(ArticleFilterType::class, $itemFilter, ['articleCategories' => $articleCategories]);
		$articleFilterForm->handleRequest($request);
		
		if ($articleFilterForm->isSubmitted() && $articleFilterForm->isValid()) {
		
			dump('asd');
			
			if ($articleFilterForm->get('search')->isClicked()) {		
				$routingParams = array();
				$routingParams = array_merge($routingParams, $itemFilter->getRequestValues());
		
				return $this->redirectToRoute($this->getIndexRoute(), $routingParams);
			}
		
			if ($articleFilterForm->get('clear')->isClicked()) {
				$routingParams = array();
		
				return $this->redirectToRoute($this->getIndexRoute(), $routingParams);
			}
		}
		
		$viewParams['articleFilterForm'] = $articleFilterForm->createView();
// 		$viewParams['tags'] = $articleFilter->getTags();
	
		return null;
	}
	
	//---------------------------------------------------------------------------
	// Params
	//---------------------------------------------------------------------------
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
		return new ArticleEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		$tokenStorage = $this->get('security.token_storage');
		return new ArticleManager($doctrine, $paginator, $tokenStorage);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new ArticleFilter());
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getEntityType()
	 */
    protected function getEntityType()
    {
    	return Article::class;
    }
}
