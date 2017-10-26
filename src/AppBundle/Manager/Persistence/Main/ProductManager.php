<?php

namespace AppBundle\Manager\Persistence\Main;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Other\CategorySummary;
use AppBundle\Entity\Main\Product;
use AppBundle\Manager\Persistence\Base\PersistenceManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Other\ProductNote;

class ProductManager extends PersistenceManager {

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Persistence\Base\PersistenceManager::saveMore()
	 *
	 * @param Product $item        	
	 */
	protected function saveMore(Request $request, $item, array $params) {
		$persistent = $this->getPersistentItem($item);
		if ($persistent) {
			if ($this->shouldInvalidate($item, $persistent)) {
				/** @var ProductCategoryAssignment $productCategoryAssignment */
				foreach ($item->getProductCategoryAssignments() as $productCategoryAssignment) {
					$this->invalidateProductNote($productCategoryAssignment->getProductNote());
					$this->invalidateCategorySummary(
							$productCategoryAssignment->getCategory()->getCategorySummary());
				}
			}
		}
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Persistence\Base\PersistenceManager::deleteMore()
	 *
	 * @param Product $item        	
	 */
	protected function deleteMore(Request $request, $item, array $params) {
		/** @var ProductCategoryAssignment $assignment */
		foreach ($item->getProductCategoryAssignments() as $assignment) {
			$this->invalidateCategorySummary($assignment->getCategory()->getCategorySummary());
		}
	}

	/**
	 *
	 * @param Product $item        	
	 */
	protected function shouldInvalidate(Product $item, $persistent) {
		return $item->getPrice() != $persistent['price'];
	}

	/**
	 *
	 * @param ProductNote $item        	
	 */
	protected function invalidateProductNote(ProductNote $item) {
		$item->setUpToDate(false);
		$this->em->persist($item);
	}

	/**
	 *
	 * @param CategorySummary $item        	
	 */
	protected function invalidateCategorySummary(CategorySummary $item) {
		$item->setUpToDate(false);
		$this->em->persist($item);
	}
}