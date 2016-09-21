<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\SimpleEntityController;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Filter\ArticleFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;

class HomeController extends SimpleEntityController
{
	/**
	 *
	 * @param Request $request
	 * @param integer $page
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction(Request $request)
	{
		return $this->indexActionInternal($request, 1);
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
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\SimpleEntityController::getEntityType()
	 */
	protected function getEntityType()
	{
		return Article::class;
	}
	
    /**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Infomarket\Base\SimpleEntityController::getEntityFilter()
     */
    protected function getEntityFilter(Request $request)
    {
    	$userRepository = $this->getDoctrine()->getRepository(User::class);
    	$articleCategoryRepository = $this->getDoctrine()->getRepository(ArticleCategory::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
		$tagRepository = $this->getDoctrine()->getRepository(Tag::class);
		
		$filter = new ArticleFilter($userRepository, $articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
    	$filter->setPublished(SimpleEntityFilter::TRUE_VALUES);
    	$filter->setFeatured(SimpleEntityFilter::TRUE_VALUES);
    	
    	$articleCategory = $this->getParamById($request, ArticleCategory::class, null);
    	if($articleCategory) {
    		$filter->setArticleCategories([$articleCategory]);
    	}
    	
    	return $filter;	
    }
    
    protected function getEntityName()
    {
    	return 'home';
    }
}
