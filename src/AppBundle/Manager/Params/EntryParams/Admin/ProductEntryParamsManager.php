<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Entity\Category;
use AppBundle\Filter\Admin\Other\CategoryFilter;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Filter\Admin\Other\ProductFilter;
use AppBundle\Entity\BenchmarkField;

class ProductEntryParamsManager extends EntryParamsManager {
	
	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$contextParams = $params['contextParams'];
			
		$category = $request->get('category');
		
		if(!$category) {
			$entry = $viewParams['entry'];
			
			$categoryRepository = $this->doctrine->getRepository(Category::class);
			$categories = $categoryRepository->findFilterItemsByProduct($entry->getId());
			
			if(count($categories) > 0) {
				$category = $categories[key($categories)];
			}
		}
		
		$categoryFilter = new CategoryFilter();
		$categoryFilter->setCategory($category);
		
		$viewParams['categoryFilter'] = $categoryFilter;
		$contextParams['category'] = $category;
		
		
		$benchmarkFieldRepository = $this->doctrine->getRepository(BenchmarkField::class);
		$productFilter = new ProductFilter($benchmarkFieldRepository);
		$productFilter->initContextParams($contextParams);
		
		$viewParams['productFilter'] = $productFilter;
		
		
		$params['viewParams'] = $viewParams;
		$params['contextParams'] = $contextParams;
    	
		return $params;
	}
}