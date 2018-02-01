<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
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
		
		$entry = $viewParams['entry'];
		$category = $request->get('category');
		
		if (! $category) {
			$categories = $this->categoryRepository->findFilterItemsByProduct($entry->getId());
			
			if (count($categories) > 0) {
				$category = $categories[key($categories)];
			}
		}
		
		$assignment = $this->getProductCategoryAssignment($entry, $category);
		if ($assignment) {
			$productValue = $assignment->getProductValue();
			$viewParams['productValue'] = $productValue;
		} else {
			$viewParams['productValue'] = null;
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

	/**
	 *
	 * @param Product $entry        	
	 * @param unknown $categoryId        	
	 *
	 * @return ProductCategoryAssignment
	 */
	protected function getProductCategoryAssignment(Product $entry, $categoryId) {
		$assignments = $entry->getProductCategoryAssignments();
		foreach ($assignments as $assignment) {
			if ($assignment->getCategory()->getId() == $categoryId) {
				return $assignment;
			}
		}
		foreach ($assignments as $assignment) {
			$mainCategory = $this->getMainCategory($assignment->getCategory());
			if ($mainCategory->getId() == $categoryId) {
				return $assignment;
			}
		}
		return $assignments->first();
	}

	/**
	 *
	 * @param Category $category        	
	 *
	 * @return Category
	 */
	protected function getMainCategory(Category $category) {
		while ($category->getParent()) {
			if ($category->getParent()->getPreleaf()) {
				return $category;
			}
			$category = $category->getParent();
		}
		
		return null;
	}
}