<?php

namespace AppBundle\Logic\Admin\Import\Product\ItemProvider;

use AppBundle\Entity\Main\ProductNote;
use AppBundle\Logic\Admin\Import\Common\ItemProvider;
use AppBundle\Logic\Admin\Import\Common\PersistenceManager;

class ProductNoteProvider extends ItemProvider {
	
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::getSearchCriteria()
	 */
	protected function getSearchCriteria(array $entry) {
		$assignment = $entry['assignment'];
		
		return ['productCategoryAssignment' => $assignment->getId()];
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::updateItem()
	 *
	 * @param ProductNote $item        	
	 */
	public function updatePersistentItem(&$item, array $entry) {
		$upToDate = false;
		
		// TODO calculate score
		// for ($j = 1; $j <= 30; $j ++) {
		// $field = 'stringNote' . $j;
		// }
		
		$item->setUpToDate($upToDate);
		
		return ! $upToDate;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::createItem()
	 */
	public function createNewItem(array $entry) {
		$item = new ProductNote();
		
		$assignment = $entry['assignment'];
		$item->setProductCategoryAssignment($assignment);
		
		$item->setUpToDate(false);
		
		// TODO calculate score
		// for ($j = 1; $j <= 30; $j ++) {
		// $field = 'stringNote' . $j;
		// }
		
		return $item;
	}
}