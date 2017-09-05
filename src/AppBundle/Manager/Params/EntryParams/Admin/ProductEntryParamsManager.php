<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Entity\Main\Category;
use AppBundle\Filter\Admin\Other\CategoryFilter;
use AppBundle\Filter\Common\Other\ProductFilter;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

class ProductEntryParamsManager extends EntryParamsManager {

	/**
	 *
	 * @var ProductFilter
	 */
	protected $productFilter;

	/**
	 *
	 * @var CategoryRepository
	 */
	protected $categoryRepository;

	public function __construct(EntityManager $em, FilterManager $fm, ProductFilter $productFilter, 
			CategoryRepository $categoryRepository) {
		parent::__construct($em, $fm);
		
		$this->productFilter = $productFilter;
		
		$this->categoryRepository = $categoryRepository;
	}

	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$contextParams = $params['contextParams'];
		
		$category = $request->get('category');
		
		if (! $category) {
			$entry = $viewParams['entry'];
			$categories = $this->categoryRepository->findFilterItemsByProduct($entry->getId());
			
			if (count($categories) > 0) {
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