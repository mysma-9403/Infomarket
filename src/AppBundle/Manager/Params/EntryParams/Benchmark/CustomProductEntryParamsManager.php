<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Entity\Category;
use AppBundle\Filter\Benchmark\CategoryFilter;
use AppBundle\Filter\Benchmark\SubcategoryFilter;
use AppBundle\Filter\Common\Other\ProductFilter;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;

class CustomProductEntryParamsManager extends EntryParamsManager {
	
	/**
	 * 
	 * @var ProductFilter
	 */
	protected $productFilter;
	
	public function __construct(EntityManager $em, FilterManager $fm, $doctrine, ProductFilter $productFilter) {
		parent::__construct($em, $fm, $doctrine);
		
		$this->productFilter = $productFilter;
	}
	
	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$contextParams = $params['contextParams'];
		
		/** @var \AppBundle\Entity\Product $entry */
		$entry = $viewParams['entry'];
		
		$assignment = $entry->getProductCategoryAssignments()->first();
		$contextParams['subcategory'] = $assignment ? $assignment->getCategory()->getId() : null;
		
		
		$this->productFilter->initContextParams($contextParams);
		$viewParams['productFilter'] = $this->productFilter;
		
		
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
		
		
		$this->productFilter->initContextParams($contextParams);
		$viewParams['productFilter'] = $this->productFilter;
	
	
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
		
		
		$this->productFilter->initContextParams($contextParams);
		$viewParams['productFilter'] = $this->productFilter;
	
	
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
	
		
		$this->productFilter->initContextParams($contextParams);
		$viewParams['productFilter'] = $this->productFilter;
	
	
		$params['viewParams'] = $viewParams;
		$params['contextParams'] = $contextParams;
	
		return $params;
	}
}