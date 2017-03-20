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
	
	protected $lastRouteParams;
	
	public function __construct($doctrine, array $lastRouteParams) {
		parent::__construct($doctrine);
		$this->lastRouteParams = $lastRouteParams;
	}
	
	public function getParams(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		$routeParams = $params['routeParams'];
		$viewParams = $params['viewParams'];
		
		$em = $this->doctrine->getManager();
		
		/** @var BranchRepository $branchRepository */
		$branchRepository = new BranchRepository($em, $em->getClassMetadata(Branch::class));
		$branches = $branchRepository->findMenuItems();
		$viewParams['menuBranches'] = $branches;
		
		$branchId = $this->getParamId($request, Branch::class, $branches[0]['id']);
		$contextParams['branch'] = $branchId;
		$routeParams['branch'] = $branchId;
    	$viewParams['contextBranchId'] = $branchId;
    	
    	
    	/** @var CategoryRepository $categoryRepository */
    	$categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
    	$categories = $categoryRepository->findContextItems($branchId);
    	$categories = $categoryRepository->getIds($categories);
    	$contextParams['categories'] = $categories;
    	
    	$categories = $categoryRepository->findMenuItems($categories);
    	$viewParams['menuCategories'] = $categories;
    	
    	
    	/** @var ArticleCategoryRepository $articleCategoryRepository */
    	$articleCategoryRepository = new ArticleCategoryRepository($em, $em->getClassMetadata(ArticleCategory::class));
    	$articleCategories = $articleCategoryRepository->findMenuItems();
    	$viewParams['menuArticleCategories'] = $articleCategories;
    	$articleCategories = $articleCategoryRepository->getIds($articleCategories);
    	$contextParams['articleCategories'] = $articleCategories;
    	
    	$params['contextParams'] = $contextParams;
    	$params['routeParams'] = $routeParams;
    	$params['viewParams'] = $viewParams;
    	
    	return $params;
	}
}