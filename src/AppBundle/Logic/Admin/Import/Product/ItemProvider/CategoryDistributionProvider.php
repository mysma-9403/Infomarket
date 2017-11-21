<?php

namespace AppBundle\Logic\Admin\Import\Product\ItemProvider;

use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Other\CategoryDistribution;
use AppBundle\Logic\Admin\Import\Common\ItemProvider;
use AppBundle\Logic\Admin\Import\Common\PersistenceManager;

class CategoryDistributionProvider extends ItemProvider {

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
	 * @param CategoryDistribution $item        	
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
	 * @param CategoryDistribution $item        	
	 */
	public function createNewItem(Category $category, array $entry) {
		$item = new CategoryDistribution();
		
		$item->setCategory($category);
		$item->setUpToDate(false);
		
		return $item;
	}
}