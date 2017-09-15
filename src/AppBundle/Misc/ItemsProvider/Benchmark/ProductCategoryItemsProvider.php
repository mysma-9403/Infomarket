<?php

namespace AppBundle\Misc\ItemsProvider\Benchmark;

use AppBundle\Misc\ItemsProvider\ItemsProvider;
use AppBundle\Repository\Benchmark\CategoryRepository;

class ProductCategoryItemsProvider implements ItemsProvider {

	/**
	 *
	 * @var CategoryRepository
	 */
	protected $repository;

	public function __construct(CategoryRepository $repository) {
		$this->repository = $repository;
	}

	public function getItems(array $params) {
		$contextParams = $params['contextParams'];
		
		$subcategoryId = $contextParams['subcategory'];
		$userId = $contextParams['user'];
		
		return $this->repository->findFilterItemsByUserAndCategory($userId, $subcategoryId);
	}
}