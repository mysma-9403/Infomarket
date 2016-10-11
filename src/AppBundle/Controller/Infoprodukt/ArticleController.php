<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\InfoproduktController;
use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\User;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Form\Filter\Infoprodukt\ArticleFilterType;
use AppBundle\Manager\Entity\Common\ArticleManager;
use AppBundle\Manager\Filter\Common\ArticleFilterManager;
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
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	protected function indexActionInternal(Request $request, $page)
	{
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
	
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
	
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
	
		$viewParams = $params['viewParams'];
	
		
		
		
		
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		$searchFilter = new SimpleEntityFilter($userRepository);
		$searchFilter->initValues($request);
		
		$searchFilterForm = $this->createForm(SimpleEntityFilterType::class, $searchFilter);
		$searchFilterForm->handleRequest($request);
		
		if ($searchFilterForm->isSubmitted() && $searchFilterForm->isValid()) {
			if ($searchFilterForm->get('search')->isClicked()) {
				return $this->redirectToRoute($this->getSearchRoute(), $searchFilter->getValues());
			}
		}
		$viewParams['searchFilterForm'] = $searchFilterForm->createView();
	
	
		
		
		
		$articleFilter = $viewParams['entryFilter'];
		
		$articleFilterForm = $this->createForm(ArticleFilterType::class, $articleFilter);
		$articleFilterForm->handleRequest($request);
		
		if ($articleFilterForm->isSubmitted() && $articleFilterForm->isValid()) {
		
			if ($articleFilterForm->get('search')->isClicked()) {
				$articleFilter->setPublished(BaseEntityFilter::ALL_VALUES);
				$articleFilter->setMain(BaseEntityFilter::ALL_VALUES);
				$articleFilter->setCategories(array());
		
				$routingParams = array();
				$routingParams['category'] = $viewParams['category']->getId();
				$routingParams = array_merge($routingParams, $articleFilter->getValues());
		
				return $this->redirectToRoute($this->getIndexRoute(), $routingParams);
			}
		
			if ($articleFilterForm->get('clear')->isClicked()) {
				$routingParams = array();
				$routingParams['category'] = $viewParams['category']->getId();
		
				return $this->redirectToRoute($this->getIndexRoute(), $routingParams);
			}
		}
		$viewParams['articleFilterForm'] = $articleFilterForm->createView();
		$viewParams['tags'] = $articleFilter->getTags();
		
		
		
		
		return $this->render($this->getIndexView(), $viewParams);
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getEntityManager($doctrine, $paginator) {
		return new ArticleManager($doctrine, $paginator);
	}
	
	protected function getEntryFilterManager($doctrine) {
		return new ArticleFilterManager($doctrine);
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
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getEntityType()
	 */
    protected function getEntityType()
    {
    	return Article::class;
    }
}
