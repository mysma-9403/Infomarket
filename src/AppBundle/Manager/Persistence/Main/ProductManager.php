<?php

namespace AppBundle\Manager\Persistence\Main;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Other\CategoryDistribution;
use AppBundle\Entity\Other\CategorySummary;
use AppBundle\Entity\Other\ProductNote;
use AppBundle\Manager\Persistence\Base\PersistenceManager;
use Symfony\Component\HttpFoundation\Request;

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
				/** @var ProductCategoryAssignment $assignment */
				foreach ($item->getProductCategoryAssignments() as $assignment) {
					$this->invalidateProductNote($assignment->getProductNote());
					$this->invalidateCategorySummary($assignment->getCategory()->getCategorySummary());
					$this->invalidateCategoryDistribution($assignment->getCategory()->getCategoryDistribution());
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
			$this->invalidateCategoryDistribution($assignment->getCategory()->getCategoryDistribution());
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

	/**
	 *
	 * @param CategoryDistribution $item        	
	 */
	protected function invalidateCategoryDistribution(CategoryDistribution $item) {
		$item->setUpToDate(false);
		$this->em->persist($item);
	}
}