<?php

namespace AppBundle\Logic\Admin\Import\Product\ItemProvider;

use AppBundle\Entity\Main\ProductScore;
use AppBundle\Logic\Admin\Import\Common\ItemProvider;
use AppBundle\Logic\Admin\Import\Common\PersistenceManager;
use AppBundle\Entity\Main\Category;

class ProductScoreProvider extends ItemProvider {

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::getSearchCriteria()
	 */
	protected function getSearchCriteria(Category $category, array $entry) {
		$assignment = $entry['assignment'];
		
		return ['productCategoryAssignment' => $assignment->getId()];
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::updateItem()
	 *
	 * @param ProductScore $item        	
	 */
	public function updatePersistentItem(&$item, array $entry) {
		$upToDate = false;
		
		// TODO calculate score
		// for ($j = 1; $j <= 30; $j ++) {
		// $field = 'stringScore' . $j;
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
	public function createNewItem(Category $category, array $entry) {
		$item = new ProductScore();
		
		$assignment = $entry['assignment'];
		$item->setProductCategoryAssignment($assignment);
		
		$item->setUpToDate(false);
		
		// TODO calculate score
		// for ($j = 1; $j <= 30; $j ++) {
		// $field = 'stringScore' . $j;
		// }
		
		return $item;
	}
}