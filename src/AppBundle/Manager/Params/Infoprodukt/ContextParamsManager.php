<?php

namespace AppBundle\Manager\Params\Infoprodukt;

use AppBundle\Entity\Category;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Infoprodukt\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

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
    	
		
		$categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class)); 
    	$categories = $categoryRepository->findMenuItems();
    	
    	$viewParams['menuCategories'] = $categories;
    	$viewParams['menuWidths'] = $this->getMenuWidths($categories);
    	
    	
    	$category = $this->getParam($request, Category::class, null);
//     	$categoryId = $this->getParamId($request, Category::class, null);
    	if($category) {
    		$contextParams['category'] = $category->getId();
    		$routeParams['category'] = $category->getId();
    		$viewParams['category'] = $category;
    		
    		$contextParams['categories'] = $categoryRepository->findContextItems($category->getId());
    	} else {
    		$contextParams['category'] = null;
    		$contextParams['categories'] = array();
    	}
    	
    	
    	$params['contextParams'] = $contextParams;
    	$params['routeParams'] = $routeParams;
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
	
	protected function getMenuWidths(array $categories, $level = 1) {
		$result = array();
		
		foreach ($categories as $category) {
			$max = 0;
			
			foreach ($category['children'] as $child) {
				$length = $level * 50 + (strlen($child['name']) + strlen($child['subname']) + 1) * 7;
				if($max < $length) {
					$max = $length;
				}
			}
			
			if($max > 0) {
				$subresults = $this->getMenuWidths($category['children'], $level+1);
				foreach ($subresults as $subresult) {
					if($max < $subresult) {
						$max = $subresult;
					}
				}
				
				$result[$category['id']] = $max;
			}
		}
	
		return $result;
	}
}