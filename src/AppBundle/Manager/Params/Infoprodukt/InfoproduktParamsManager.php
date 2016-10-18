<?php

namespace AppBundle\Manager\Params\Infoprodukt;

use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\BranchFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Params\Base\ParamsManager;
use Symfony\Component\HttpFoundation\Request;

class InfoproduktParamsManager extends ParamsManager {
	
	public function getParams(Request $request, array $params) {
		$routeParams = $params['routeParams'];
		$viewParams = $params['viewParams'];
		
		
		
		$userRepository = $this->doctrine->getRepository(User::class);
    	$branchRepository = $this->doctrine->getRepository(Branch::class);
    	$categoryRepository = $this->doctrine->getRepository(Category::class);
		
		
    	$branchFilter = new BranchFilter($userRepository, $categoryRepository);
    	$branchFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$branchFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
    	
    	$branches = $this->getParamList(Branch::class, $branchFilter);
    	$viewParams['menuBranches'] = $branches;
    	
    	
    	$categoryFilter = new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
    	$categoryFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$categoryFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
    	$categoryFilter->setRoot(BaseEntityFilter::TRUE_VALUES);
    	$categoryFilter->setOrderBy('e.name ASC');
    	$categoryFilter->setLimit(5);
    	 
    	$categories = $this->getParamList(Category::class, $categoryFilter);
    	
    	$temp = $categories[0];
    	if(count($temp->getMenuChildren()) < 1) {
	    	$categoryFilter->setRoot(BaseEntityFilter::FALSE_VALUES);
	    	$categoryFilter->setLimit(10);
	    	$categories = $this->prepareCategories($categories, $categoryFilter);
    	}
    	
    	$viewParams['menuCategories'] = $categories;
    	
    	
    	
    	$category = $this->getCategory($request);
    	if($category) {
    		$routeParams['category'] = $category->getId();
    		$viewParams['category'] = $category;
    	}
    	
    	
    	
    	$params['routeParams'] = $routeParams;
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
	
	protected function prepareCategories(array $categories, CategoryFilter $categoryFilter) {
		foreach ($categories as $category) {
			$categoryFilter->setParents([$category]);
			
			$subcategories = $this->getParamList(Category::class, $categoryFilter);
			$subcategories = $this->prepareCategories($subcategories, $categoryFilter);
			
			$category->setMenuChildren($subcategories);
		}
		
		return $categories;
	}
	
	protected function getCategory(Request $request) {
		return $this->getParam($request, Category::class);
	}
}