<?php

namespace AppBundle\Misc\ItemsProvider;

use AppBundle\Repository\Base\BaseRepository;

class RepositoryItemsProvider implements ItemsProvider {

	/**
	 *
	 * @var BaseRepository
	 */
	protected $repository;

	public function __construct(BaseRepository $repository) {
		$this->repository = $repository;
	}

	public function getItems(array $params) {
		return $this->repository->findFilterItems();
	}
}