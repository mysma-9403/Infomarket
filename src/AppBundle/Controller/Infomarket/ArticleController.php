<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\SimpleEntityController;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Filter\ArticleFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;

class ArticleController extends SimpleEntityController
{   
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
	
	/**
	 *
	 * @param Request $request
	 * @param integer $page
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function homeAction(Request $request, $page)
	{
		$params = $this->initIndexParams($request, $page);
		
		return $this->render('infomarket/home/index.html.twig', $params);
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
    	$filter->setPublished(true);
    	
    	$articleCategory = $this->getParamByName($request, ArticleCategory::class, null);
    	if($articleCategory) {
    		$filter->setArticleCategories([$articleCategory]);
    	}
    	
    	return $filter;	
    }
}
