<?php

namespace AppBundle\Logic\Admin\Import\Common;

use AppBundle\Repository\Base\BaseRepository;

abstract class ItemProvider {
	
	/**
	 *
	 * @var BaseRepository
	 */
	protected $repository;
	
	public function __construct(BaseRepository $repository) {
		$this->repository = $repository;
	}
	
	public function getPersistentItem(array $entry) {
		return $this->repository->findOneBy($this->getSearchCriteria($entry));
	}
	
	protected abstract function getSearchCriteria(array $entry);
	
	/**
	 * @return boolean - return <b>true</b> if entry needs to be updated
	 */
	public function updatePersistentItem(&$item, array $entry) {
		return false;
	}
	
	/**
	 * @return mixed - return new entry (e.g. <b>Product</b>)
	 */
	public abstract function createNewItem(array $entry);
}