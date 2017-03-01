<?php

namespace AppBundle\Manager\Params\Benchmark;

use AppBundle\Entity\Category;
use AppBundle\Manager\Params\Base\ParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Benchmark\CategoryRepository;

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
		
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
		$categories = $categoryRepository->findFilterItems();
		
		$categoryId = $this->getParamId($request, Category::class, $categories[key($categories)]);
		$category = $categoryRepository->findItem($categoryId);
		
		$contextParams['category'] = $categoryId;
		$routeParams['category'] = $categoryId;
		$viewParams['category'] = $category;
		
		
		$subcategories = $categoryRepository->findFilterItemsByCategory($categoryId);
		$subcategoryId = $this->getParamIdByName($request, 'subcategory', $subcategories[key($subcategories)]);
		$subcategory = $categoryRepository->findItem($subcategoryId);
		
		$contextParams['subcategory'] = $subcategoryId;
		$routeParams['subcategory'] = $subcategoryId;
		$viewParams['subcategory'] = $subcategory;
		
    	
    	$params['contextParams'] = $contextParams;
    	$params['routeParams'] = $routeParams;
    	$params['viewParams'] = $viewParams;
    	
    	return $params;
	}
}