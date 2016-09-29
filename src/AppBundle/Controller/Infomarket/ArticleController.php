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
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Branch;
use AppBundle\Entity\BranchCategoryAssignment;

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
     * {@inheritDoc}
     * @see \AppBundle\Controller\Infomarket\Base\SimpleEntityController::getEntityType()
     */
    protected function getEntityType()
    {
    	return Article::class;
    }
    
    protected function getEntityFilter(Request $request)
    {
    	$filter = parent::getEntityFilter($request);
    	
    	$routingParams = $this->getRoutingParams($request);
    	$branch = $routingParams['branch'];
    	if($branch) {
    		$categories = array();
    		foreach ($branch->getBranchCategoryAssignments() as $branchCategoryAssignment) {
    			$categories[] = $branchCategoryAssignment->getCategory();
    		}
    		$filter->setCategories($categories);
    	}
    	 
    	$filter->setMain(SimpleEntityFilter::TRUE_VALUES);
    	$filter->setOrderBy('e.date DESC');
    	 
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
