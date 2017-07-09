<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Entity\Category;
use AppBundle\Filter\Admin\Other\CategoryFilter;
use AppBundle\Filter\Common\Other\ProductFilter;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;

class ProductEntryParamsManager extends EntryParamsManager {
	
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
		
		
		$this->productFilter->initContextParams($contextParams);
		$viewParams['productFilter'] = $this->productFilter;
		
		
		$params['viewParams'] = $viewParams;
		$params['contextParams'] = $contextParams;
    	
		return $params;
	}
}