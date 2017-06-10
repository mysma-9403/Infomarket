<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Category;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Filter\Benchmark\CategoryFilter;
use AppBundle\Filter\Benchmark\SubcategoryFilter;
use AppBundle\Repository\Admin\Main\BenchmarkFieldRepository;
use AppBundle\Filter\Benchmark\Other\ProductFilter;

class CustomProductEntryParamsManager extends EntryParamsManager {
	
	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$contextParams = $params['contextParams'];
		
		/** @var \AppBundle\Entity\Product $entry */
		$entry = $viewParams['entry'];
		
		$assignment = $entry->getProductCategoryAssignments()->first();
		$contextParams['subcategory'] = $assignment ? $assignment->getCategory()->getId() : null;
		
		$em = $this->doctrine->getManager();
		$benchmarkFieldRepository = new BenchmarkFieldRepository($em, $em->getClassMetadata(BenchmarkField::class));
		$productFilter = new ProductFilter($benchmarkFieldRepository);
		$productFilter->initContextParams($contextParams);
		
		$viewParams['productFilter'] = $productFilter;
		
		
		$params['viewParams'] = $viewParams;
		$params['contextParams'] = $contextParams;
    	
		return $params;
	}
	
	public function getNewParams(Request $request, array $params) {
		$params = parent::getNewParams($request, $params);
	
		$viewParams = $params['viewParams'];
		$contextParams = $params['contextParams'];
			
		$category = $contextParams['category'];
		$subcategory = $contextParams['subcategory'];
	
		$categoryFilter = new CategoryFilter();
		$categoryFilter->setCategory($category);
	
		$subcategoryFilter = new SubcategoryFilter();
		$subcategoryFilter->setSubcategory($subcategory);
	
		$viewParams['categoryFilter'] = $categoryFilter;
		$viewParams['subcategoryFilter'] = $subcategoryFilter;
		
		$em = $this->doctrine->getManager();
		$benchmarkFieldRepository = new BenchmarkFieldRepository($em, $em->getClassMetadata(BenchmarkField::class));
		$productFilter = new ProductFilter($benchmarkFieldRepository);
		$productFilter->initContextParams($contextParams);
	
		$viewParams['productFilter'] = $productFilter;
	
	
		$params['viewParams'] = $viewParams;
		$params['contextParams'] = $contextParams;
		
		return $params;
	}
	
	public function getEditParams(Request $request, array $params, $id) {
		$params = parent::getEditParams($request, $params, $id);
	
		$viewParams = $params['viewParams'];
		$contextParams = $params['contextParams'];
		
		/** @var \AppBundle\Entity\Product $entry */
		$entry = $viewParams['entry'];
		
		$assignment = $entry->getProductCategoryAssignments()->first();
		$contextParams['subcategory'] = $assignment ? $assignment->getCategory()->getId() : null; 
		
		$em = $this->doctrine->getManager();
		$benchmarkFieldRepository = new BenchmarkFieldRepository($em, $em->getClassMetadata(BenchmarkField::class));
		$productFilter = new ProductFilter($benchmarkFieldRepository);
		$productFilter->initContextParams($contextParams);
	
		$viewParams['productFilter'] = $productFilter;
	
	
		$params['viewParams'] = $viewParams;
		$params['contextParams'] = $contextParams;
	
		return $params;
	}
	
	public function getCopyParams(Request $request, array $params, $id) {
		$params = parent::getCopyParams($request, $params, $id);
	
		$viewParams = $params['viewParams'];
		$contextParams = $params['contextParams'];
	
		/** @var \AppBundle\Entity\Product $entry */
		$template = $viewParams['template'];
	
		$assignment = $template->getProductCategoryAssignments()->first();
		$contextParams['subcategory'] = $assignment ? $assignment->getCategory()->getId() : null;
	
		$em = $this->doctrine->getManager();
		$benchmarkFieldRepository = new BenchmarkFieldRepository($em, $em->getClassMetadata(BenchmarkField::class));
		$productFilter = new ProductFilter($benchmarkFieldRepository);
		$productFilter->initContextParams($contextParams);
	
		$viewParams['productFilter'] = $productFilter;
	
	
		$params['viewParams'] = $viewParams;
		$params['contextParams'] = $contextParams;
	
		return $params;
	}
}