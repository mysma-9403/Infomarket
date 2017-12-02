<?php

namespace AppBundle\Manager\Params\Benchmark;

use AppBundle\Entity\Main\Category;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Benchmark\BenchmarkMessageRepository;
use AppBundle\Repository\Benchmark\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Main\User;
use AppBundle\Entity\Assignments\UserCategoryAssignment;

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
		
		/** @var \AppBundle\Entity\Main\User $user */
		$user = $this->tokenStorage->getToken()->getUser();
		$contextParams['user'] = $user->getId();
		
		$subcategory = $this->getRequestCategory($request, $user, 'subcategory');
		if ($subcategory) {
			$category = $subcategory->getParent();
		} else {
			$category = $this->getRequestCategory($request, $user);
			$lastSubcategoryId = key_exists('subcategory', $lastRouteParams) ? $lastRouteParams['subcategory'] : null;
			
			if ($category) {
				if ($lastSubcategoryId) {
					$subcategory = $this->findUserCategory($user, $lastSubcategoryId);
					
					if (! $subcategory || $subcategory->getParent()->getId() !== $category->getId()) {
						$subcategory = $this->findFirstUserChildCategory($user, $category);
					}
				} else {
					$subcategory = $this->findFirstUserChildCategory($user, $category);
				}
			} else {
				if ($lastSubcategoryId) {
					$subcategory = $this->findUserCategory($user, $lastSubcategoryId);
					$category = $subcategory->getParent();
				} else {
					$lastCategoryId = key_exists('category', $lastRouteParams) ? $lastRouteParams['category'] : null;
					if ($lastCategoryId) {
						$category = $this->findUserCategory($user, $lastCategoryId);
						if ($category) {
							$subcategory = $this->findFirstUserChildCategory($user, $category);
						}
					} else {
						$category = $this->findFirstUserMainCategory($user);
					}
				}
			}
		}
		
		$categoryId = $category ? $category->getId() : null;
		$contextParams['category'] = $categoryId;
		$routeParams['category'] = $categoryId;
		$viewParams['category'] = $category;
		
		$subcategoryId = $subcategory ? $subcategory->getId() : null;
		$contextParams['subcategory'] = $subcategoryId;
		$routeParams['subcategory'] = $subcategoryId;
		$viewParams['subcategory'] = $subcategory;
		
		$unreadMessagesCount = $this->benchmarkMessageRepository->findUnreadItemsCountByAuthor($user->getId());
		$viewParams['unreadMessagesCount'] = $unreadMessagesCount;
		
		$params['contextParams'] = $contextParams;
		$params['routeParams'] = $routeParams;
		$params['viewParams'] = $viewParams;
		
		return $params;
	}

	private function getRequestCategory(Request $request, User $user, $name = 'category') {
		$id = $this->paramsManager->getIdByName($request, $name, null);
		return $id ? $this->findUserCategory($user, $id) : null;
	}
	
	private function findFirstUserMainCategory(User $user) {
		/** @var UserCategoryAssignment $assignment */
		foreach ($user->getUserCategoryAssignments() as $assignment) {
			$category = $assignment->getCategory();
			if ($category->getPreleaf()) {
				return $category;
			}
		}
		return null;
	}
	
	private function findFirstUserChildCategory(User $user, Category $category) {
		/** @var Category $child */
		foreach ($category->getChildren() as $child) {
			if ($this->findUserCategory($user, $child->getId())) {
				return $child;
			}
		}
		return null;
	}
	
	private function findUserCategory(User $user, $id) {
		dump($id);
		/** @var UserCategoryAssignment $assignment */
		foreach ($user->getUserCategoryAssignments() as $assignment) {
			$category = $assignment->getCategory();
			if ($category->getId() == $id) {
				return $category;
			}
		}
		return null;
	}
}