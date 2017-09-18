<?php

namespace AppBundle\Misc\ItemsProvider\Benchmark;

use AppBundle\Misc\ItemsProvider\ItemsProvider;
use AppBundle\Repository\Benchmark\BrandRepository;

class ProductBrandItemsProvider implements ItemsProvider {

	/**
	 *
	 * @var BrandRepository
	 */
	protected $repository;

	public function __construct(BrandRepository $repository) {
		$this->repository = $repository;
	}

	public function getItems(array $params) {
		$contextParams = $params['contextParams'];
		
		$subcategoryId = $contextParams['subcategory'];
		
		return $this->repository->findFilterItemsByCategory($subcategoryId);
	}
}