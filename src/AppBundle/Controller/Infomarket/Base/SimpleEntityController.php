<?php

namespace AppBundle\Controller\Infomarket\Base;

use AppBundle\AppBundle;
use AppBundle\Controller\Base\BaseEntityController;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Base\SimpleEntity;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ArticleCategoryFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\BranchFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\Filter\LinkFilter;
use AppBundle\Entity\Filter\PageFilter;
use AppBundle\Entity\Link;
use AppBundle\Entity\Page;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class SimpleEntityController extends BaseEntityController
{   
	//TODO refactor
    /**
     * 
     * @param Request $request
     */
    protected function getParams(Request $request)
    {
    	$params = parent::getParams($request);
    	$params = array_merge($params, $this->getAdvertParams($request));
    	$params = array_merge($params, $this->getRoutingParams($request));
    	
    	$userRepository = $this->getDoctrine()->getRepository(User::class);
    	$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
    	$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
    	 
    	
    	$branchFilter = new BranchFilter($userRepository, $categoryRepository);
    	$branchFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
    	$branchFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
    	 
    	$branches = $this->getParamList(Branch::class, $branchFilter);
    	$params['menuBranches'] = $branches;
    	
    	
    	$articleCategoryFilter = new ArticleCategoryFilter($userRepository);
    	$articleCategoryFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
    	$articleCategoryFilter->setFeatured(SimpleEntityFilter::TRUE_VALUES);
    	$articleCategoryFilter->setOrderBy('e.orderNumber ASC');
    	 
    	$articleCategories = $this->getParamList(ArticleCategory::class, $articleCategoryFilter);
    	$params['menuArticleCategories'] = $articleCategories;
    	
    	
    	$categoryFilter = new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
    	$categoryFilter->setBranches(array($params['branch']));
    	$categoryFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
    	$categoryFilter->setRoot(SimpleEntityFilter::TRUE_VALUES);
    	$categoryFilter->setOrderBy('e.name ASC');
    	
    	$categories = $this->getParamList(Category::class, $categoryFilter);
    	$params['menuCategories'] = $categories;
    	
    	
    	$pageFilter = new PageFilter($userRepository);
    	$pageFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
    	$pageFilter->setFeatured(SimpleEntityFilter::TRUE_VALUES);
    	$pageFilter->setOrderBy('e.orderNumber ASC');
    	 
    	$pages = $this->getParamList(Page::class, $pageFilter);
    	$params['menuPages'] = $pages;
    	 
    	
    	$linkFilter = new LinkFilter($userRepository);
    	$linkFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$linkFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
    	$linkFilter->setTypes([Link::FOOTER_LINK]);
    	$linkFilter->setOrderBy('e.orderNumber ASC');
    	 
    	$links = $this->getParamList(Link::class, $linkFilter);
    	$params['menuLinks'] = $links;
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
//     	$category = $this->getParamById($request, Category::class, null);
    	
//     	$pathCategories = array();
    	
//     	if($category) {
//     		if(false) {//TODO $category->getBranchCategoryAssignment()->getBranch()->getId() != $branch->getId()) {
//     			$category = null;
//     		} else {
//     			$pathCategories = $this->addWithParent($pathCategories, $category);
//     		}
//     	}
    	
    	
//     	$params['pathCategories'] = $pathCategories;
    	
//     	$params['categoryFilter'] = $categoryFilter;
    	 
    	return $params;
    }
    
    protected function getRouteParams(Request $request) {
    	$routeParams = parent::getRouteParams($request);
    	
    	$branch = $this->getParamById($request, Branch::class, null);
    	
    	if($branch == null) {
    		$lastRoutingParams = $this->getRoutingParams($request);
    		$lastRouteParams = $lastRoutingParams['routeParams'];
    		if(array_key_exists('branch', $lastRouteParams)) {
    			$repository = $this->getDoctrine()->getRepository(Branch::class);
    			$branch = $repository->find($lastRouteParams['branch']);
    		}
    	}
    	
    	if($branch == null) {
    		$userRepository = $this->getDoctrine()->getRepository(User::class);
    		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
    	
    		$branchFilter = new BranchFilter($userRepository, $categoryRepository);
    		$branchFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
    		$branchFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
    		 
    		$branches = $this->getParamList(Branch::class, $branchFilter);
    	
    		$branch = $branches[0];
    	}
    	
    	$routeParams['branch'] = $branch->getId();
    
    	return $routeParams;
    }
    
    protected function getRoutingParams(Request $request)
    {
    	$params = parent::getRoutingParams($request);
    	
    	$branch = $this->getParamById($request, Branch::class, null);
    	
    	if($branch == null) {
    		$routeParams = $params['routeParams'];
    		if(array_key_exists('branch', $routeParams)) {
    			$repository = $this->getDoctrine()->getRepository(Branch::class);
    			$branch = $repository->find($routeParams['branch']);
    		}
    	}
    	
    	if($branch == null) {
	    	$userRepository = $this->getDoctrine()->getRepository(User::class);
	    	$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
	    	
	    	$branchFilter = new BranchFilter($userRepository, $categoryRepository);
	    	$branchFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
	    	$branchFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
	    	 
	    	$branches = $this->getParamList(Branch::class, $branchFilter);
	    	
	    	$branch = $branches[0];
    	}
    	
    	$params['branch'] = $branch;
    	 
    	return $params;
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
