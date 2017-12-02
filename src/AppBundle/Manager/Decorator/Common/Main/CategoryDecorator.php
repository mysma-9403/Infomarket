<?php

namespace AppBundle\Manager\Decorator\Common\Main;

use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Other\CategorySummary;
use AppBundle\Factory\Item\Base\ItemFactory;
use AppBundle\Manager\Decorator\Base\ItemDecorator;

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

	public function __construct(ItemFactory $categorySummaryFactory, ItemDecorator $categorySummaryDecorator) {
		$this->categorySummaryFactory = $categorySummaryFactory;
		$this->categorySummaryDecorator = $categorySummaryDecorator;
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
}