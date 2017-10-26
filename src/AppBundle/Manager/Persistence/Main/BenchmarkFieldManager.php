<?php

namespace AppBundle\Manager\Persistence\Main;

use AppBundle\Manager\Persistence\Base\PersistenceManager;
use AppBundle\Entity\Main\BenchmarkField;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Assignments\ProductCategoryAssignment;

class BenchmarkFieldManager extends PersistenceManager {
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Manager\Persistence\Base\PersistenceManager::saveMore()
	 *
	 * @param BenchmarkField $item
	 */
	protected function saveMore(Request $request, $item, array $params) {
		/** @var ProductCategoryAssignment $assignment */
		foreach ($item->getCategory()->getProductCategoryAssignments() as $assignment) {
			$this->invalidateProductNote($assignment->getProductNote());
		}
	
		$this->invalidateCategorySummary($item->getCategory()->getCategorySummary());
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Manager\Persistence\Base\PersistenceManager::deleteMore()
	 *
	 * @param BenchmarkField $item
	 */
	protected function deleteMore(Request $request, $item, array $params) {
		/** @var ProductCategoryAssignment $assignment */
		foreach ($item->getCategory()->getProductCategoryAssignments() as $assignment) {
			$this->invalidateProductNote($assignment->getProductNote());
		}
	
		$this->invalidateCategorySummary($item->getCategory()->getCategorySummary());
	}
	
	/**
	 *
	 * @param ProductNote $item
	 */
	protected function invalidateProductNote($item) {
		$item->setUpToDate(false);
		$this->em->persist($item);
	}
	
	/**
	 *
	 * @param CategorySummary $item
	 */
	protected function invalidateCategorySummary($item) {
		$item->setUpToDate(false);
		$this->em->persist($item);
	}
}