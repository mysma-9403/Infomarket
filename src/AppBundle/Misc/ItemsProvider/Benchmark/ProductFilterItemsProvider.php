<?php

namespace AppBundle\Misc\ItemsProvider\Benchmark;

use AppBundle\Misc\ItemsProvider\ItemsProvider;
use AppBundle\Repository\Benchmark\ProductRepository;

class ProductFilterItemsProvider implements ItemsProvider {

	/**
	 *
	 * @var ProductRepository
	 */
	protected $repository;

	public function __construct(ProductRepository $repository) {
		$this->repository = $repository;
	}

	public function getItems(array $params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		$subcategoryId = $contextParams['subcategory'];
		
		/** @var ProductFilter $filter */
		$filter = $viewParams['entryFilter'];
		
		$choices = [];
		foreach ($filter->getFilterFields() as $field) {
			$valueField = $field['valueField'];
			$choices[$valueField] = $this->repository->findFilterItemsByValue($subcategoryId, $valueField);
		}
		return $choices;
	}
}