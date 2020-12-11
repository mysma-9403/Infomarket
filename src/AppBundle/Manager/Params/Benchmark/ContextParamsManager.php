<?php

namespace AppBundle\Manager\Params\Benchmark;

use AppBundle\Entity\Main\Category;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Benchmark\BenchmarkMessageRepository;
use AppBundle\Repository\Benchmark\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Main\User;
use AppBundle\Entity\Assignments\UserCategoryAssignment;
use AppBundle\Repository\Admin\Assignments\UserCategoryAssignmentRepository;

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
	 * @var UserCategoryAssignmentRepository
	 */
	protected $userCategoryAssignmentRepository;

	/**
	 *
	 * @var BenchmarkMessageRepository
	 */
	protected $benchmarkMessageRepository;

	public function __construct(CategoryRepository $categoryRepository, 
			UserCategoryAssignmentRepository $userCategoryAssignmentRepository, 
			BenchmarkMessageRepository $benchmarkMessageRepository, ParamsManager $paramsManager, $tokenStorage) {
		$this->categoryRepository = $categoryRepository;
		$this->userCategoryAssignmentRepository = $userCategoryAssignmentRepository;
		$this->benchmarkMessageRepository = $benchmarkMessageRepository;
		$this->paramsManager = $paramsManager;
		$this->tokenStorage = $tokenStorage;
	}

	public function getParams(Request $request, array $params) {
		/** @var \AppBundle\Entity\Main\User $user */
		$user = $this->tokenStorage->getToken()->getUser();
		
		if ($user instanceof User) {
			$lastRouteParams = $params['lastRouteParams'];
			$contextParams = $params['contextParams'];
			$routeParams = $params['routeParams'];
			$viewParams = $params['viewParams'];
			
			$contextParams['user'] = $user->getId();
			
			$hasCategoryAccess = true;
			$hasSubcategoryAccess = true;
			
			$category = null;
			$subcategory = null;
			
			$categoryId = null;
			$subcategoryId = null;
			
			$subcategoryId = $this->paramsManager->getIdByName($request, 'subcategory');
			if ($subcategoryId) {
				$subcategory = $this->categoryRepository->find($subcategoryId);
				$hasSubcategoryAccess = $this->hasAccess($user->getId(), $subcategoryId);
				if ($hasSubcategoryAccess) {
					$category = $subcategory->getParent();
					$categoryId = $category->getId();
				}
			} else {
				$categoryId = $this->paramsManager->getIdByName($request, 'category');
				if ($categoryId) {
					$category = $this->categoryRepository->find($categoryId);
					$hasCategoryAccess = $this->hasAccess($user->getId(), $categoryId);
					if ($hasCategoryAccess) {
						$subcategory = $this->findFirstUserChildCategory($user, $category);
						if ($subcategory) {
							$subcategoryId = $subcategory->getId();
						} else {
							$hasSubcategoryAccess = false;
							$subcategoryId = null;
						}
					}
				} else {
					$subcategoryId = key_exists('subcategory', $lastRouteParams) ? $lastRouteParams['subcategory'] : null;
					if ($subcategoryId && $this->hasAccess($user->getId(), $subcategoryId)) {
						$subcategory = $this->categoryRepository->find($subcategoryId);
						$category = $subcategory->getParent();
						$categoryId = $category->getId();
					} else {
						$categoryId = key_exists('category', $lastRouteParams) ? $lastRouteParams['category'] : null;
						if ($categoryId && $this->hasAccess($user->getId(), $categoryId)) {
							$category = $this->categoryRepository->find($categoryId);
							$subcategory = $this->findFirstUserChildCategory($user, $category);
							if ($subcategory) {
								$subcategoryId = $subcategory->getId();
							} else {
								$hasSubcategoryAccess = false;
								$subcategoryId = null;
							}
						} else {
							$category = $this->findFirstUserMainCategory($user);
							if ($category) {
								$categoryId = $category->getId();
								$subcategory = $this->findFirstUserChildCategory($user, $category);
								if ($subcategory) {
									$subcategoryId = $subcategory->getId();
								} else {
									$hasSubcategoryAccess = false;
									$subcategoryId = null;
								}
							} else {
								$hasCategoryAccess = false;
								$categoryId = null;
							}
						}
					}
				}
			}
			
			$viewParams['hasCategoryAccess'] = $hasCategoryAccess;
			$viewParams['hasSubcategoryAccess'] = $hasSubcategoryAccess;
			
			$contextParams['category'] = $categoryId;
			$routeParams['category'] = $categoryId;
			$viewParams['category'] = $category;
			
			$contextParams['subcategory'] = $subcategoryId;
			$routeParams['subcategory'] = $subcategoryId;
			$viewParams['subcategory'] = $subcategory;
			
			$unreadMessagesCount = $this->benchmarkMessageRepository->findUnreadItemsCountByAuthor(
					$user->getId());
			$viewParams['unreadMessagesCount'] = $unreadMessagesCount;
			
			$params['contextParams'] = $contextParams;
			$params['routeParams'] = $routeParams;
			$params['viewParams'] = $viewParams;
		}
		
		return $params;
	}

	private function hasAccess($userId, $categoryId) {
		$assignment = $this->userCategoryAssignmentRepository->findOneBy(
				['user' => $userId, 'category' => $categoryId]);
		return $assignment != null;
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