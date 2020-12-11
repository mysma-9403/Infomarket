<?php

namespace AppBundle\Logic\Admin\Import\Product\ItemProvider;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Logic\Admin\Import\Common\ItemProvider;
use AppBundle\Logic\Admin\Import\Common\PersistenceManager;
use AppBundle\Entity\Main\Category;

class ProductCategoryAssignmentProvider extends ItemProvider {

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::getSearchCriteria()
	 */
	protected function getSearchCriteria(Category $category, array $entry) {
		$product = $entry['product'];
		
		return ['product' => $product, 'category' => $category];
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
		$forUpdate = false;
		
		$segment = $entry['segment'];
		if ($segment && (! $item->getSegment() || $item->getSegment()->getId() != $segment->getId())) {
			$item->setSegment($segment);
			$forUpdate = true;
		}
		
		$featured = $entry['featured'];
		if($featured != $item->getFeatured()) {
			$item->setFeatured($featured);
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
	 * @param ProductCategoryAssignment $item        	
	 */
	public function createNewItem(Category $category, array $entry) {
		$item = new ProductCategoryAssignment();
		
		$item->setProduct($entry['product']);
		$item->setSegment($entry['segment']);
		$item->setCategory($entry['category']);
		$item->setFeatured($entry['featured']);
		$item->setOrderNumber(99);
		
		return $item;
	}
}