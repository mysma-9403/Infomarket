<?php

namespace AppBundle\Manager\Persistence\Main;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Other\CategorySummary;
use AppBundle\Entity\Other\ProductNote;
use AppBundle\Manager\Persistence\Base\PersistenceManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Other\ProductValue;
use AppBundle\Entity\Other\ProductScore;

class ProductManager extends PersistenceManager {

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Persistence\Base\PersistenceManager::saveMore()
	 *
	 * @param Product $item        	
	 */
	protected function saveMore(Request $request, $item, $persistent, array $params) {
		if (! $persistent || $this->shouldInvalidate($item, $persistent)) {
			
			if ($item->getProductCategoryAssignments()) {
				/** @var ProductCategoryAssignment $assignment */
				foreach ($item->getProductCategoryAssignments() as $assignment) {
					if (! $assignment->getProductValue()) {
						$this->createProductValue($assignment);
						$this->createProductScore($assignment);
						$this->createProductNote($assignment);
					} else {
						$this->invalidateProductNote($assignment->getProductNote());
					}
					$this->invalidateCategorySummary($assignment->getCategory()->getCategorySummary());
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

	protected function createProductValue(ProductCategoryAssignment $assignment) {
		$value = new ProductValue();
		$value->setProductCategoryAssignment($assignment);
		
		return $value;
	}

	protected function createProductScore(ProductCategoryAssignment $assignment) {
		$score = new ProductScore();
		$score->setProductCategoryAssignment($assignment);
		$score->setUpToDate(false);
		
		return $score;
	}

	protected function createProductNote(ProductCategoryAssignment $assignment) {
		$note = new ProductNote();
		$note->setProductCategoryAssignment($assignment);
		$note->setOveralNote(2.0); // TODO first note should be calculated here!
		$note->setUpToDate(false);
		
		return $note;
	}

	/**
	 *
	 * @param Product $item        	
	 */
	protected function shouldInvalidate(Product $item, $persistent) {
		return $item->getPrice() != $persistent['price'] || $item->getBenchmark() != $persistent['benchmark'];
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