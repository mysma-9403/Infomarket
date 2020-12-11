<?php

namespace AppBundle\Manager\Params\Infoprodukt;

use AppBundle\Entity\Main\Category;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Infoprodukt\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

class ContextParamsManager extends ParamsManager {

	/**
	 *
	 * @var array
	 */
	protected $lastRouteParams;

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
	public function __construct(CategoryRepository $categoryRepository, ParamsManager $paramsManager, 
			array $lastRouteParams) {
		$this->categoryRepository = $categoryRepository;
		
		$this->paramsManager = $paramsManager;
		
		$this->lastRouteParams = $lastRouteParams;
	}

	public function getParams(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		$routeParams = $params['routeParams'];
		$viewParams = $params['viewParams'];
		
		$categories = $this->categoryRepository->findMenuItems();
		$viewParams['menuCategories'] = $categories;
		$viewParams['menuWidths'] = $this->getMenuWidths($categories);
		
		$categoryId = $this->paramsManager->getIdByClass($request, Category::class, null);
		if ($categoryId) {
			$contextParams['category'] = $categoryId;
			$routeParams['category'] = $categoryId;
			$viewParams['category'] = $this->categoryRepository->findOneBy(['slugUrl' => $categoryId]);

			$categories = $this->categoryRepository->findContextParents($categoryId);
			$categories = array_merge($categories, $this->categoryRepository->findContextChildren($categoryId));
			$contextParams['categories'] = $categories;
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
			if (isset($category['children'])) {
                foreach ($category['children'] as $child) {
                    $length = $level * 50 + (strlen($child['name']) + strlen($child['subname']) + 1) * 7;
                    if ($max < $length) {
                        $max = $length;
                    }
                }

                if ($max > 0) {
                    $subresults = $this->getMenuWidths($category['children'], $level + 1);
                    foreach ($subresults as $subresult) {
                        if ($max < $subresult) {
                            $max = $subresult;
                        }
                    }

                    $result[$category['id']] = $max;
                }
            }
		}
		
		return $result;
	}
}
