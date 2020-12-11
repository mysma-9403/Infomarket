<?php

namespace AppBundle\Misc\ItemsProvider;

use AppBundle\Repository\Admin\Main\CategoryRepository;

class CategoryItemsProvider implements ItemsProvider {

	/**
	 * 
	 * @var CategoryRepository
	 */
	protected $repository;
	
	public function __construct(CategoryRepository $repository) { //TODO make common CategoryRepository
		$this->repository = $repository;
	}
	
	public function getItems(array $params) {
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		return $this->repository->findFilterItemsByProduct($entry->getId());
	}
}