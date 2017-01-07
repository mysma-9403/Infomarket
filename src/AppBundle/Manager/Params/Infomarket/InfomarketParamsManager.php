<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ArticleCategoryFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\BranchFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Params\Base\ParamsManager;
use Symfony\Component\HttpFoundation\Request;

class InfomarketParamsManager extends ParamsManager {
	
	protected $doctrine;
	
	protected $lastRouteParams;
	
	public function __construct($doctrine, array $lastRouteParams) {
		$this->doctrine = $doctrine;
		$this->lastRouteParams = $lastRouteParams;
	}
	
	public function getParams(Request $request, array $params) {
		$routeParams = $params['routeParams'];
		$viewParams = $params['viewParams'];
		
		$userRepository = $this->doctrine->getRepository(User::class);
		$branchRepository = $this->doctrine->getRepository(Branch::class);
    	$categoryRepository = $this->doctrine->getRepository(Category::class);
		 
		
    	
		$branchFilter = new BranchFilter($userRepository, $categoryRepository);
		$branchFilter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
		$branchFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
		
		$branches = $this->getParamList(Branch::class, $branchFilter);
		$viewParams['menuBranches'] = $branches;
		
		$branch = $this->getBranch($request, $branches[0]);
    	$routeParams['branch'] = $branch->getId();
    	$viewParams['branch'] = $branch;
    	
    	
    	$categoryFilter = new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
    	$categoryFilter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
    	$categoryFilter->setRoot(BaseEntityFilter::TRUE_VALUES);
    	$categoryFilter->setBranches(array($branch));
    	$categoryFilter->setOrderBy('e.name ASC');
    	
    	$categories = $this->getParamList(Category::class, $categoryFilter);
    	$viewParams['menuCategories'] = $categories;
    	
    	
    	$articleCategoryFilter = new ArticleCategoryFilter($userRepository);
    	$articleCategoryFilter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
    	$articleCategoryFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
    	$articleCategoryFilter->setOrderBy('e.orderNumber ASC');
    	 
    	$articleCategories = $this->getParamList(ArticleCategory::class, $articleCategoryFilter);
    	$viewParams['menuArticleCategories'] = $articleCategories;
    	
    	$params['routeParams'] = $routeParams;
    	$params['viewParams'] = $viewParams;
    	
    	return $params;
	}
	
	protected function getBranch(Request $request, Branch $template) {
		$branch = $this->getParam($request, Branch::class);
		 
		if($branch == null) {
			if(array_key_exists('branch', $this->lastRouteParams)) {
				$repository = $this->doctrine->getRepository(Branch::class);
				$branch = $repository->find($this->lastRouteParams['branch']);
			}
		}
		 
		if($branch == null) {
			$branch = $template;
		}
		
		return $branch;
	}
}