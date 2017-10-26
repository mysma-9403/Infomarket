<?php

namespace AppBundle\Manager\Persistence\Main;

use AppBundle\Manager\Persistence\Base\PersistenceManager;
use AppBundle\Entity\Main\BenchmarkEnum;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Assignments\ProductCategoryAssignment;

class BenchmarkEnumManager extends PersistenceManager {
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Manager\Persistence\Base\PersistenceManager::saveMore()
	 *
	 * @param BenchmarkEnum $item
	 */
	protected function saveMore(Request $request, $item, array $params) {
		/** @var ProductCategoryAssignment $assignment */
		foreach ($item->getCategory()->getProductCategoryAssignments() as $assignment) {
			$this->invalidateProductScore($assignment->getProductScore());
			$this->invalidateProductNote($assignment->getProductNote());
		}
	
		$this->invalidateCategorySummary($item->getCategory()->getCategorySummary());
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Manager\Persistence\Base\PersistenceManager::deleteMore()
	 *
	 * @param BenchmarkEnum $item
	 */
	protected function deleteMore(Request $request, $item, array $params) {
		/** @var ProductCategoryAssignment $assignment */
		foreach ($item->getCategory()->getProductCategoryAssignments() as $assignment) {
			$this->invalidateProductScore($assignment->getProductScore());
			$this->invalidateProductNote($assignment->getProductNote());
		}
	
		$this->invalidateCategorySummary($item->getCategory()->getCategorySummary());
	}
	
	/**
	 *
	 * @param ProductScore $item
	 */
	protected function invalidateProductScore($item) {
		$item->setUpToDate(false);
		$this->em->persist($item);
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