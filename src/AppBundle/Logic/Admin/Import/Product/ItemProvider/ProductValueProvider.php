<?php

namespace AppBundle\Logic\Admin\Import\Product\ItemProvider;

use AppBundle\Entity\Other\ProductValue;
use AppBundle\Logic\Admin\Import\Common\ItemProvider;
use AppBundle\Logic\Admin\Import\Common\PersistenceManager;
use AppBundle\Entity\Main\Category;

class ProductValueProvider extends ItemProvider {

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
	 * @param ProductValue $item        	
	 */
	public function updatePersistentItem(&$item, array $entry) {
		$forUpdate = false;
		
		/** @var ProductValue $productValue */
		$productValue = $entry['productValue'];
		
		for ($j = 1; $j <= 30; $j ++) {
			$field = 'decimal' . $j;
			$value = (float)$productValue->offsetGet($field);
			if ((float)$item->offsetGet($field) !== $value) {
				$item->offsetSet($field, $value);
				$forUpdate = true;
			}
			
			$field = 'integer' . $j;
			$value = (int)$productValue->offsetGet($field);
			if ((int)$item->offsetGet($field) !== $value) {
				$item->offsetSet($field, $value);
				$forUpdate = true;
			}
			
			$field = 'string' . $j;
			$value = $productValue->offsetGet($field);
			if ($item->offsetGet($field) !== $value) {
				$item->offsetSet($field, $value);
				$forUpdate = true;
			}
		}
		
		return $forUpdate;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::createItem()
	 *
	 * @param ProductValue $item        	
	 */
	public function createNewItem(Category $category, array $entry) {
		$item = new ProductValue();
		
		$assignment = $entry['assignment'];
		$item->setProductCategoryAssignment($assignment);
		
		/** @var ProductValue $productValue */
		$productValue = $entry['productValue'];
		
		for ($j = 1; $j <= 30; $j ++) {
			$field = 'decimal' . $j;
			$value = $productValue->offsetGet($field);
			$item->offsetSet($field, $value);
			
			$field = 'integer' . $j;
			$value = $productValue->offsetGet($field);
			$item->offsetSet($field, $value);
			
			$field = 'string' . $j;
			$value = $productValue->offsetGet($field);
			$item->offsetSet($field, $value);
		}
		
		return $item;
	}
}