<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\SimpleEntityController;
use AppBundle\Entity\Article;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Category;
use AppBundle\Form\Filter\Infoprodukt\ArticleFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;

class ArticleController extends SimpleEntityController
{   
	/**
	 * 
	 * @param Request $request
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	protected function indexActionInternal(Request $request, $page)
	{
		$this->sendPageviewAnalytics($request);
		
		$params = $this->getIndexParams($request, $page);
		
		//TODO brzydki override, pomyslec czy da sie ladniej :)
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		
		$searchFilter = new SimpleEntityFilter($userRepository);
		$searchFilter->initValues($request);
	
		$searchFilterForm = $this->createForm(SimpleEntityFilterType::class, $searchFilter);
		$searchFilterForm->handleRequest($request);

		if ($searchFilterForm->isSubmitted() && $searchFilterForm->isValid()) {
			if ($searchFilterForm->get('search')->isClicked()) {
				return $this->redirectToRoute('infoprodukt_search', $searchFilter->getValues());
			}
		}
		$params['searchFilterForm'] = $searchFilterForm->createView();
	
		$filter = $this->getEntityFilter($request);
	
		$filterForm = $this->createForm(ArticleFilterType::class, $filter);
		$filterForm->handleRequest($request);
	
		if ($filterForm->isSubmitted() && $filterForm->isValid()) {
				
			if ($filterForm->get('search')->isClicked()) {
				$filter->setPublished(SimpleEntityFilter::ALL_VALUES);
				$filter->setMain(SimpleEntityFilter::ALL_VALUES);
				$filter->setCategories(array());
				
				$routingParams = array();
				$routingParams['category'] = $params['category']->getId();
				$routingParams = array_merge($routingParams, $filter->getValues());
				
				return $this->redirectToRoute($this->getIndexRoute(), $routingParams);
			}
				
			if ($filterForm->get('clear')->isClicked()) {
				$routingParams = array();
				$routingParams['category'] = $filter->getCategories()[0]->getId();
				
				return $this->redirectToRoute($this->getIndexRoute(), $routingParams);
			}
		}
		$params['articleFilterForm'] = $filterForm->createView();
		$params['tags'] = $filter->getTags();
			
		return $this->render($this->getIndexView(), $params);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getEntityType()
	 */
    protected function getEntityType()
    {
    	return Article::class;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getEntityFilter()
     */
    protected function getEntityFilter(Request $request)
    {
    	$filter = parent::getEntityFilter($request);
    	
    	$category = $this->getParamById($request, Category::class, null);
    	if($category) {
    		$filter->setCategories([$category]);
    	}
    	
    	$filter->setMain(SimpleEntityFilter::TRUE_VALUES);
    	$filter->setOrderBy('e.publishedAt DESC');
    	
    	return $filter;
    }
    
    protected function createNewFilter() {
    	$userRepository = $this->getDoctrine()->getRepository(User::class);
    	$articleCategoryRepository = $this->getDoctrine()->getRepository(ArticleCategory::class);
    	$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
    	$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
    	$tagRepository = $this->getDoctrine()->getRepository(Tag::class);
    	
    	return new ArticleFilter($userRepository, $articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
    }
}
