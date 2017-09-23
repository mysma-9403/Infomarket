<?php

namespace AppBundle\Manager\Params\Benchmark;

use AppBundle\Entity\Main\Category;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Benchmark\BenchmarkMessageRepository;
use AppBundle\Repository\Benchmark\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

class ContextParamsManager {

	protected $tokenStorage;

	/**
	 *
	 * @var ParamsManager
	 */
	protected $paramsManager;

	/**
	 *
	 * @var CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 *
	 * @var BenchmarkMessageRepository
	 */
	protected $benchmarkMessageRepository;

	public function __construct(CategoryRepository $categoryRepository, 
			BenchmarkMessageRepository $benchmarkMessageRepository, ParamsManager $paramsManager, $tokenStorage) {
		$this->categoryRepository = $categoryRepository;
		$this->benchmarkMessageRepository = $benchmarkMessageRepository;
		$this->paramsManager = $paramsManager;
		$this->tokenStorage = $tokenStorage;
	}

	public function getParams(Request $request, array $params) {
		$lastRouteParams = $params['lastRouteParams'];
		$contextParams = $params['contextParams'];
		$routeParams = $params['routeParams'];
		$viewParams = $params['viewParams'];
		
		$userId = $this->tokenStorage->getToken()->getUser()->getId();
		$contextParams['user'] = $userId;
		
		$lastCategoryId = key_exists('category', $lastRouteParams) ? $lastRouteParams['category'] : null;
		$category = $this->getCategory($request, $lastCategoryId, $userId);
		
		$contextParams['category'] = $category['id'];
		$routeParams['category'] = $category['id'];
		$viewParams['category'] = $category;
		
		
		$lastSubcategoryId = key_exists('subcategory', $lastRouteParams) ? $lastRouteParams['subcategory'] : null;
		$subcategory = $this->getSubcategory($request, $lastSubcategoryId, $category['id'], $userId);
		
		$contextParams['subcategory'] = $subcategory['id'];
		$routeParams['subcategory'] = $subcategory['id'];
		$viewParams['subcategory'] = $subcategory;
		
		
		$unreadMessagesCount = $this->benchmarkMessageRepository->findUnreadItemsCountByAuthor($userId);
		$viewParams['unreadMessagesCount'] = $unreadMessagesCount;
		
		$params['contextParams'] = $contextParams;
		$params['routeParams'] = $routeParams;
		$params['viewParams'] = $viewParams;
		
		return $params;
	}

	protected function getCategory(Request $request, $lastCategoryId, $userId) {
		$categories = $this->categoryRepository->findFilterItemsByUser($userId);
		
		if (count($categories) > 0) {
			$categoryId = $this->paramsManager->getIdByClass($request, Category::class, $lastCategoryId);
			
			if (! in_array($categoryId, $categories)) {
				$categoryId = $categories[key($categories)];
			}
			return $this->categoryRepository->findItem($categoryId);
		}
		
		return ['id' => -1];
	}

	protected function getSubcategory(Request $request, $lastSubcategoryId, $categoryId, $userId) {
		$subcategories = $this->categoryRepository->findFilterItemsByUserAndCategory($userId, $categoryId);
		
		if (count($subcategories) > 0) {
			$subcategoryId = $this->paramsManager->getIdByName($request, 'subcategory', $lastSubcategoryId);
			
			if (! in_array($subcategoryId, $subcategories)) {
				$subcategoryId = $subcategories[key($subcategories)];
			}
			return $this->categoryRepository->findItem($subcategoryId);
		}
		
		return ['id' => -1];
	}
}