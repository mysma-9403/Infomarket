<?php

namespace AppBundle\Logic\Admin\Import\Product\ItemProvider;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Logic\Admin\Import\Common\ItemProvider;
use AppBundle\Logic\Admin\Import\Common\PersistenceManager;
use AppBundle\Entity\Main\Category;

class ProductProvider extends ItemProvider {

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::getSearchCriteria()
	 */
	protected function getSearchCriteria(Category $category, array $entry) {
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::updateItem()
	 *
	 * @param ProductCategoryAssignment $item        	
	 */
	public function updatePersistentItem(&$item, array $entry) {
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::createItem()
	 *
	 * @param ProductCategoryAssignment $item        	
	 */
	public function createNewItem(Category $category, array $entry) {
	}
}