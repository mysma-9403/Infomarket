<?php

namespace AppBundle\Logic\Admin\Import\Common;

use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Entity\Main\Category;

abstract class ItemProvider {
	
	/**
	 *
	 * @var BaseRepository
	 */
	protected $repository;
	
	public function __construct(BaseRepository $repository) {
		$this->repository = $repository;
	}
	
	public function getPersistentItem(Category $category, array $entry) {
		return $this->repository->findOneBy($this->getSearchCriteria($category, $entry));
	}
	
	protected abstract function getSearchCriteria(Category $category, array $entry);
	
	/**
	 * @return boolean - return <b>true</b> if entry needs to be updated
	 */
	public function updatePersistentItem(&$item, array $entry) {
		return false;
	}
	
	/**
	 * @return mixed - return new entry (e.g. <b>Product</b>)
	 */
	public abstract function createNewItem(Category $category, array $entry);
}