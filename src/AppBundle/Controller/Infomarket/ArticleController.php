<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\InfomarketController;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Category;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Infomarket\Main\ArticleFilter;
use AppBundle\Form\Filter\Infomarket\ArticleFilterType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Infomarket\ArticleManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infomarket\ArticleEntryParamsManager;
use AppBundle\Repository\Infomarket\ArticleCategoryRepository;
use AppBundle\Repository\Infomarket\CategoryRepository;
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
	
		$response = $this->initPreviewForms($request, $params);
		if($response) return $response;
		
		$viewParams = $params['viewParams'];
	
		return $this->render($this->getShowView(), $viewParams);
	}
	
	//---------------------------------------------------------------------------
	// Actions blocks
	//---------------------------------------------------------------------------
	
	protected function initPreviewForms(Request $request, array &$params) {
		return $this->initShowForms($request, $params);
	}
	
	protected function initIndexForms(Request $request, array &$params) {
		$response = parent::initIndexForms($request, $params);
		if($response) return $response;
		
		$response = $this->initFilterForm($request, $params);
		if($response) return $response;
	
		return null;
	}
	
	protected function initFilterForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		/** @var Filter $itemFilter */ 
		$itemFilter = $viewParams['entryFilter'];

		$branchId = $viewParams['contextBranchId'];
		
		$em = $this->getDoctrine()->getManager();
		
		/** @var ArticleCategoryRepository $articleCategoryRepository */
		$articleCategoryRepository = new ArticleCategoryRepository($em, $em->getClassMetadata(ArticleCategory::class));
		$articleCategories = $articleCategoryRepository->findFilterItems();
		
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
		$categories = $categoryRepository->findFilterItemsByBranch($branchId);
		
		$articleFilterForm = $this->createForm(ArticleFilterType::class, $itemFilter, ['articleCategories' => $articleCategories, 'categories' => $categories]);
		$articleFilterForm->handleRequest($request);
		
		if ($articleFilterForm->isSubmitted() && $articleFilterForm->isValid()) {
		
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

		$params['viewParams'] = $viewParams;
	
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
