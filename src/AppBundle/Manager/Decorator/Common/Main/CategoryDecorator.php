<?php

namespace AppBundle\Manager\Decorator\Common\Main;

use AppBundle\Entity\Main\Category;
use AppBundle\Factory\Item\Base\ItemFactory;
use AppBundle\Entity\Other\CategorySummary;
use AppBundle\Manager\Decorator\Base\ItemDecorator;
use AppBundle\Entity\Other\CategoryDistribution;

class CategoryDecorator extends ItemDecorator {

	/**
	 *
	 * @var ItemFactory
	 */
	protected $categorySummaryFactory;

	/**
	 *
	 * @var ItemDecorator
	 */
	protected $categorySummaryDecorator;

	/**
	 *
	 * @var ItemFactory
	 */
	protected $categoryDistributionFactory;

	/**
	 *
	 * @var ItemDecorator
	 */
	protected $categoryDistributionDecorator;

	public function __construct(ItemFactory $categorySummaryFactory, ItemDecorator $categorySummaryDecorator, 
			ItemFactory $categoryDistributionFactory, ItemDecorator $categoryDistributionDecorator) {
		$this->categorySummaryFactory = $categorySummaryFactory;
		$this->categorySummaryDecorator = $categorySummaryDecorator;
		$this->categoryDistributionFactory = $categoryDistributionFactory;
		$this->categoryDistributionDecorator = $categoryDistributionDecorator;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Decorator\Base\ItemDecorator::getPrepared()
	 *
	 * @param Category $item        	
	 */
	public function getPrepared($item) {
		$item = $this->updateRoot($item);
		
		if (! $item->getCategorySummary()) {
			$item->setCategorySummary($this->createCategorySummary($item));
		}
		
		if (! $item->getCategoryDistribution()) {
			$item->setCategoryDistribution($this->createCategoryDistribution($item));
		}
		
		return $item;
	}

	/**
	 *
	 * @param Category $item        	
	 */
	protected function updateRoot(Category $item) {
		$parent = $item->getParent();
		if ($parent) {
			$rootId = $parent->getRootId();
			if ($rootId) {
				$item->setRootId($rootId);
			} else {
				$item->setRootId($parent->getId());
			}
		} else {
			$item->setRootId(null);
		}
		return $item;
	}

	/**
	 *
	 * @param Category $item        	
	 */
	protected function createCategorySummary(Category $item) {
		/** @var CategorySummary $result */
		$result = $this->categorySummaryFactory->create();
		$result->setCategory($item);
		
		$result = $this->categorySummaryDecorator->getPrepared($result);
		
		return $result;
	}

	/**
	 *
	 * @param Category $item        	
	 */
	protected function createCategoryDistribution(Category $item) {
		/** @var CategoryDistribution $result */
		$result = $this->categoryDistributionFactory->create();
		$result->setCategory($item);
		
		$result = $this->categoryDistributionDecorator->getPrepared($result);
		
		return $result;
	}
}