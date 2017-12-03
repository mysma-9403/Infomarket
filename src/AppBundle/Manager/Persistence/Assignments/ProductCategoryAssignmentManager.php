<?php

namespace AppBundle\Manager\Persistence\Assignments;

use AppBundle\Manager\Persistence\Base\PersistenceManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Other\ProductScore;
use AppBundle\Entity\Other\ProductNote;
use AppBundle\Entity\Other\CategorySummary;

class ProductCategoryAssignmentManager extends PersistenceManager {

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Persistence\Base\PersistenceManager::saveMore()
	 *
	 * @param ProductCategoryAssignment $item        	
	 */
	protected function saveMore(Request $request, $item, $persistent, array $params) {
		if ($persistent) {
			$this->invalidateProductScore($item->getProductScore());
			$this->invalidateProductNote($item->getProductNote());
		}
		
		$this->invalidateCategorySummary($item->getCategory()->getCategorySummary());
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Persistence\Base\PersistenceManager::deleteMore()
	 *
	 * @param ProductCategoryAssignment $item        	
	 */
	protected function deleteMore(Request $request, $item, array $params) {
		$this->invalidateCategorySummary($item->getCategory()->getCategorySummary());
	}

	/**
	 *
	 * @param ProductScore $item        	
	 */
	protected function invalidateProductScore(ProductScore $item) {
		$item->setUpToDate(false);
		$this->em->persist($item);
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