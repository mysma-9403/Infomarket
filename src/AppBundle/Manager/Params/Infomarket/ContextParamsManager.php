<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Entity\Branch;
use AppBundle\Repository\Infomarket\ArticleCategoryRepository;
use AppBundle\Repository\Infomarket\BranchRepository;
use AppBundle\Repository\Infomarket\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Params\Base\ParamsManager;

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
	 * @var ParamsManager
	 */
	protected $paramsManager;
	
	// TODO lastRouteParams should be moved to function params or within params array -> then it will be possible to define service
	public function __construct(ArticleCategoryRepository $articleCategoryRepository, BranchRepository $branchRepository, CategoryRepository $categoryRepository, ParamsManager $paramsManager, array $lastRouteParams) {
		$this->articleCategoryRepository = $articleCategoryRepository;
		$this->branchRepository = $branchRepository;
		$this->categoryRepository = $categoryRepository;
		
		$this->paramsManager = $paramsManager;
		
		$this->lastRouteParams = $lastRouteParams;
	}

	public function getParams(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		$routeParams = $params['routeParams'];
		$viewParams = $params['viewParams'];
		
		$branches = $this->getMenuBranches($contextParams, $viewParams);
		$viewParams['menuBranches'] = $branches;
		
		$templateId = null;
		if (array_key_exists('branch', $this->lastRouteParams)) {
			$templateId = $this->lastRouteParams['branch'];
		} else {
			$templateId = $branches[0]['id'];
		}
		
		$branch = $this->paramsManager->getIdByClass($request, Branch::class, $templateId);
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