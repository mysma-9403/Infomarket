<?php

namespace AppBundle\Manager\Persistence\Main;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Other\CategoryDistribution;
use AppBundle\Entity\Other\CategorySummary;
use AppBundle\Entity\Other\ProductNote;
use AppBundle\Manager\Persistence\Base\PersistenceManager;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkFieldManager extends PersistenceManager {

	/**
	 *
	 * {@inheritDoc}
	 *
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
		$this->invalidateCategoryDistribution($item->getCategory()->getCategoryDistribution());
	}

	/**
	 *
	 * {@inheritDoc}
	 *
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
		$this->invalidateCategoryDistribution($item->getCategory()->getCategoryDistribution());
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