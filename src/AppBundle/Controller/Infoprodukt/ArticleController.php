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
    	$articleCategoryRepository = $this->getDoctrine()->getRepository(ArticleCategory::class);
    	$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
    	
    	$filter = new ArticleFilter($articleCategoryRepository, $categoryRepository);
    	$filter->setPublished(SimpleEntityFilter::TRUE_VALUES);
    	$filter->setMain(SimpleEntityFilter::TRUE_VALUES);
    	
    	return $filter;
    }
}
