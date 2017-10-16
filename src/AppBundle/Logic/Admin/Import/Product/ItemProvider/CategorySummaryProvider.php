<?php

namespace AppBundle\Logic\Admin\Import\Product\ItemProvider;

use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\CategorySummary;
use AppBundle\Logic\Admin\Import\Common\ItemProvider;
use AppBundle\Logic\Admin\Import\Common\PersistenceManager;

class CategorySummaryProvider extends ItemProvider {

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::getSearchCriteria()
	 */
	protected function getSearchCriteria(Category $category, array $entry) {
		return ['category' => $category];
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::updateItem()
	 *
	 * @param CategorySummary $item        	
	 */
	public function updatePersistentItem(&$item, array $entry) {
		$forUpdate = false;
		
		if ($item->getUpToDate()) {
			$item->setUpToDate(false);
			$forUpdate = true;
		}
		
		return $forUpdate;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::createItem()
	 *
	 * @param CategorySummary $item        	
	 */
	public function createNewItem(Category $category, array $entry) {
		$item = new CategorySummary();
		
		$item->setCategory($category);
		$item->setUpToDate(false);
		
		return $item;
	}
}