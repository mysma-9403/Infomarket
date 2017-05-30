<?php

namespace AppBundle\Manager\Params\Benchmark;

use AppBundle\Entity\Category;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Benchmark\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Benchmark\BenchmarkMessageRepository;
use AppBundle\Entity\BenchmarkMessage;

class ContextParamsManager extends ParamsManager {
	
	protected $lastRouteParams;
	
	protected $tokenStorage;
	
	/**
	 *
	 * @var BenchmarkMessageRepository
	 */
	protected $benchmarkMessageRepository;
	
	public function __construct($doctrine, array $lastRouteParams, $tokenStorage) {
		parent::__construct($doctrine);
		$this->lastRouteParams = $lastRouteParams;
		$this->tokenStorage = $tokenStorage;
		
		$em = $this->doctrine->getManager();
		
		$this->benchmarkMessageRepository = new BenchmarkMessageRepository($em, $em->getClassMetadata(BenchmarkMessage::class));
	}
	
	public function getParams(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		$routeParams = $params['routeParams'];
		$viewParams = $params['viewParams'];
		
		$em = $this->doctrine->getManager();
		
		
		$userId = $this->tokenStorage->getToken()->getUser()->getId();
		
		
		$categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
		
		
		$categories = $categoryRepository->findFilterItemsByUser($userId);
		
		$categoryId = 0;
		$category = null;
		
		if(count($categories) > 0) {
			$categoryId = $this->getParamId($request, Category::class, $categories[key($categories)]);
			$category = $categoryRepository->findItem($categoryId);
		}
		
		$contextParams['category'] = $categoryId;
		$routeParams['category'] = $categoryId;
		$viewParams['category'] = $category;
		
		
		$subcategoryId = 0;
		$subcategory = null;
		
		$subcategories = $categoryRepository->findFilterItemsByUserAndCategory($userId, $categoryId);
		
		if(count($subcategories) > 0) {
			$subcategoryId = $this->getParamIdByName($request, 'subcategory');
			if(!in_array($subcategoryId, $subcategories)) {
				$subcategoryId = $subcategories[key($subcategories)];
			}
			$subcategory = $categoryRepository->findItem($subcategoryId);
		}
		
		$contextParams['subcategory'] = $subcategoryId;
		$routeParams['subcategory'] = $subcategoryId;
		$viewParams['subcategory'] = $subcategory;
		
		
		
		$unreadMessagesCount = $this->getUnreadMessagesCount();
		$viewParams['unreadMessagesCount'] = $unreadMessagesCount;
		
    	
    	$params['contextParams'] = $contextParams;
    	$params['routeParams'] = $routeParams;
    	$params['viewParams'] = $viewParams;
    	
    	return $params;
	}
	
	protected function getUnreadMessagesCount() {
		return $this->benchmarkMessageRepository->findUnreadItemsCount();
	}
}