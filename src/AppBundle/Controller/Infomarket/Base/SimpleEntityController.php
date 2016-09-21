<?php

namespace AppBundle\Controller\Infomarket\Base;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\BranchFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Utils\ClassUtils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\AppBundle;
use AppBundle\Controller\Base\BaseEntityController;
use AppBundle\Entity\Base\SimpleEntity;
use AppBundle\Entity\User;

abstract class SimpleEntityController extends BaseEntityController
{   
	//TODO refactor
    /**
     * 
     * @param Request $request
     */
    protected function getParams(Request $request)
    {
    	$params = [];
    	
    	$userRepository = $this->getDoctrine()->getRepository(User::class);
    	$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
    	$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
    	
    	$branchFilter = new BranchFilter($userRepository, $categoryRepository);
    	$branchFilter->setPublished(true);
    	$branches = $this->getParamList(Branch::class, $branchFilter);
    	
    	$branch = $this->initBranch($request, $branches);
    	
    	
    	$categoryFilter = new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
    	$categoryFilter->initValues($request); //TODO make it better :P
    	
    	$categoryFilter->setPublished(true);
    	if($branch) $categoryFilter->setBranches([$branch]);
    	$categoryFilter->setRoot($this->showRootCategories());
    	$categoryFilter->setPreleaf($this->showPreleafCategories());
    	
    	$categories = $this->getParamList(Category::class, $categoryFilter);
    	
    	$category = $this->getParamById($request, Category::class, null);
    	
    	$pathCategories = array();
    	
    	if($category) {
    		if(false) {//TODO $category->getBranchCategoryAssignment()->getBranch()->getId() != $branch->getId()) {
    			$category = null;
    		} else {
    			$pathCategories = $this->addWithParent($pathCategories, $category);
    		}
    	}
    	
    	$articleCategoryFilter = new SimpleEntityFilter($userRepository);
    	//$articleCategoryFilter->setBranch($branch);
    	$articleCategories = $this->getParamList(ArticleCategory::class, $articleCategoryFilter);
    	
    	$articleCategory = $this->getParamByName($request, ArticleCategory::class, $articleCategories[0]->getName());
    	
    	
    	
    	$params['branch'] = $branch;
    	$params['category'] = $category;
    	$params['article_category'] = $articleCategory;
    	
    	$params['branches'] = $branches;
    	$params['categories'] = $categories;
    	$params['article_categories'] = $articleCategories;
    	
    	$params['pathCategories'] = $pathCategories;
    	
    	$params['categoryFilter'] = $categoryFilter;
    	 
    	return $params;
    }
    
    protected function initBranch(Request $request, $branches)
    {
    	return $this->getParamByName($request, Branch::class, $branches[0]->getName());
    }
    
    protected function showRootCategories()
    {
    	return SimpleEntityFilter::TRUE_VALUES;
    }
    
    protected function showPreleafCategories()
    {
    	return SimpleEntityFilter::FALSE_VALUES;
    }    
    
    protected function addWithParent($list, $entry) {
    	array_unshift($list, $entry);
    	
    	if($entry->getParent() != null) {
    		$list = $this->addWithParent($list, $entry->getParent());
    	}
    	
    	return $list;
    }
    
    /**
     * 
     */
    protected function getEntityType() {
    	return SimpleEntity::class;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \AppBundle\Controller\Base\SimpleEntityController::createNewFilter()
     */
    protected function getEntityFilter(Request $request) {
    	$filter = parent::getEntityFilter($request);
    	$filter->setPublished(SimpleEntityFilter::TRUE_VALUES);
    
    	return $filter;
    }
    
    /**
     * 
     * @param Request $request
     * @return number
     */
    protected function getPageEntries(Request $request) 
    {
    	return 20;
    }
    
    protected function getBaseName()
    {
    	return 'infomarket';
    }
}
