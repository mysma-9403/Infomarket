<?php

namespace AppBundle\Misc\ItemsProvider\Benchmark;

use AppBundle\Misc\ItemsProvider\ItemsProvider;
use AppBundle\Repository\Benchmark\CategoryRepository;

class CategoryItemsProvider implements ItemsProvider {

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
		$userId = $contextParams['user'];
		
		return $this->repository->findFilterItemsByUser($userId);
	}
}