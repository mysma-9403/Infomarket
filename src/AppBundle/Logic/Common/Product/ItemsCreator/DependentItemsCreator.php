<?php

namespace AppBundle\Logic\Common\Product\ItemsCreator;

use AppBundle\Repository\Logic\ProductNote\DependentItemsRepository;

class DependentItemsCreator {

	/**
	 *
	 * @var DependentItemsRepository
	 */
	private $repository;

	public function __construct(DependentItemsRepository $repository) {
		$this->repository = $repository;
	}

	public function createFrom(array $items) {
		$total = count($items);
		$done = 0;
		
		if ($total > 0) {
			$this->repository->createFrom($items);
			$done = $total;
		}
		
		return ['total' => $total, 'done' => $done];
	}
}