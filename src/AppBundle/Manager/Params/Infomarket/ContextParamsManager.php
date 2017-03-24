<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Manager\Params\Base\ParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Infomarket\BranchRepository;
use AppBundle\Repository\Infomarket\CategoryRepository;
use AppBundle\Repository\Infomarket\ArticleCategoryRepository;

class ContextParamsManager extends ParamsManager {
	
	/**
	 * 
	 * @var array
	 */
	protected $lastRouteParams;

	/**
	 * 
	 * @var ArticleCategoryRepository
	 */
	protected $articleCategoryRepository;
	
	/**
	 *
	 * @var BranchRepository
	 */
	protected $branchRepository;
	
	/**
	 * 
	 * @var CategoryRepository
	 */
	protected $categoryRepository;
	
	public function __construct($doctrine, array $lastRouteParams) {
		parent::__construct($doctrine);
		
		$this->lastRouteParams = $lastRouteParams;
		
		$em = $this->doctrine->getManager();
		
		$this->articleCategoryRepository = new ArticleCategoryRepository($em, $em->getClassMetadata(ArticleCategory::class));
		$this->branchRepository = new BranchRepository($em, $em->getClassMetadata(Branch::class));
		$this->categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
	}
	
	public function getParams(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		$routeParams = $params['routeParams'];
		$viewParams = $params['viewParams'];
		
		$branches = $this->getMenuBranches($contextParams, $viewParams);
		$viewParams['menuBranches'] = $branches;
		
		$branch = $this->getParamId($request, Branch::class, $branches[0]['id']);
		$contextParams['branch'] = $branch;
		$routeParams['branch'] = $branch;
    	$viewParams['contextBranchId'] = $branch;
    	
    	
    	$contextParams['categories'] = $this->getContextCategories($contextParams, $viewParams);
    	$viewParams['menuCategories'] = $this->getMenuCategories($contextParams, $viewParams);
    	
    	
    	$viewParams['menuArticleCategories'] = $this->getMenuArticleCategories($contextParams, $viewParams);
    	$contextParams['articleCategories'] = $this->getContextArticleCategories($contextParams, $viewParams);
    	
    	$params['contextParams'] = $contextParams;
    	$params['routeParams'] = $routeParams;
    	$params['viewParams'] = $viewParams;
    	
    	return $params;
	}
	
	
	protected function getMenuBranches($contextParams, $viewParams) {
		return $this->branchRepository->findMenuItems();
	}
	
	
	protected function getContextCategories($contextParams, $viewParams) {
		$branch = $contextParams['branch'];
		
		$categories = $this->categoryRepository->findContextItems($branch);
		$categories = $this->categoryRepository->getIds($categories);
		
		return $categories;
	}
	
	protected function getMenuCategories($contextParams, $viewParams) {
		$categories = $contextParams['categories'];
		return $this->categoryRepository->findMenuItems($categories);
	}
	
	
	protected function getMenuArticleCategories($contextParams, $viewParams) {
		return $this->articleCategoryRepository->findMenuItems();
	}
	
	protected function getContextArticleCategories($contextParams, $viewParams) {
		$articleCategories = $viewParams['menuArticleCategories'];
		return $this->articleCategoryRepository->getIds($articleCategories);
	}
}