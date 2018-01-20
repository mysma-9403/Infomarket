<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Entity\Main\Branch;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Admin\Assignments\ProductCategoryAssignmentRepository;
use AppBundle\Repository\Infomarket\ArticleCategoryRepository;
use AppBundle\Repository\Infomarket\BranchRepository;
use AppBundle\Repository\Infomarket\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

class ContextParamsManager {

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

	/**
	 *
	 * @var ProductCategoryAssignmentRepository
	 */
	protected $productCategoryAssignmentRepository;

	/**
	 *
	 * @var ParamsManager
	 */
	protected $paramsManager;
	
	// TODO lastRouteParams should be moved to function params or within params array -> then it will be possible to define service
	public function __construct(ArticleCategoryRepository $articleCategoryRepository, 
			BranchRepository $branchRepository, CategoryRepository $categoryRepository, 
			ProductCategoryAssignmentRepository $productCategoryAssignmentRepository, 
			ParamsManager $paramsManager, array $lastRouteParams) {
		$this->articleCategoryRepository = $articleCategoryRepository;
		$this->branchRepository = $branchRepository;
		$this->categoryRepository = $categoryRepository;
		$this->productCategoryAssignmentRepository = $productCategoryAssignmentRepository;
		
		$this->paramsManager = $paramsManager;
		
		$this->lastRouteParams = $lastRouteParams;
	}

	public function getParams(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		$routeParams = $params['routeParams'];
		$viewParams = $params['viewParams'];
		
		$branches = $this->getMenuBranches($contextParams, $viewParams);
		$viewParams['menuBranches'] = $branches;
		
		$branch = $this->paramsManager->getIdByClass($request, Branch::class);
		
		if ($branch === null) {
			if (array_key_exists('branch', $this->lastRouteParams)) {
				$branch = $this->lastRouteParams['branch'];
			}
		}
		
		if ($branch === null) {
			$branch = $this->initBranch($branches, $branch);
		}
		
		$contextParams['branch'] = $branch;
		$routeParams['branch'] = $branch;
		$viewParams['contextBranchId'] = $branch;
		
		if ($branch > 0) {
			$contextParams['categories'] = $this->getContextCategories($contextParams, $viewParams);
			$viewParams['menuCategories'] = $this->getMenuCategories($contextParams, $viewParams);
			
			$viewParams['menuArticleCategories'] = $this->getMenuArticleCategories($contextParams, $viewParams);
			$contextParams['articleCategories'] = $this->getContextArticleCategories($contextParams, 
					$viewParams);
		}
		
		$params['contextParams'] = $contextParams;
		$params['routeParams'] = $routeParams;
		$params['viewParams'] = $viewParams;
		
		return $params;
	}
	
	// TODO refine - quick fix...
	protected function initBranch($branches, $branch) {
		return $branch ? $branch : $branches[0]['id'];
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
		if (count($categories) > 0) {
			$result = [];
			$menuCategories = $this->categoryRepository->findMenuItems($categories);
			foreach ($menuCategories as $menuCategory) {
				$ids = $this->getAllCategoryIds($menuCategory);
				$item = $this->productCategoryAssignmentRepository->findOneBy(['category' => $ids]);
				if ($item)
					$result[] = $menuCategory;
			}
			return $result;
		} else {
			return [];
		}
	}

	private function getAllCategoryIds($category) {
		$result = [$category['id']];
		
		foreach ($category['children'] as $category) {
			$result = array_merge($result, $this->getAllCategoryIds($category));
		}
		
		return $result;
	}

	protected function getMenuArticleCategories($contextParams, $viewParams) {
		return $this->articleCategoryRepository->findMenuItems();
	}

	protected function getContextArticleCategories($contextParams, $viewParams) {
		$articleCategories = $viewParams['menuArticleCategories'];
		return $this->articleCategoryRepository->getIds($articleCategories);
	}
}