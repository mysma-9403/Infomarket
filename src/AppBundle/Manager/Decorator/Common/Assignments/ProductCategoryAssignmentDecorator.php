<?php

namespace AppBundle\Manager\Decorator\Common\Assignments;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Other\ProductNote;
use AppBundle\Entity\Other\ProductScore;
use AppBundle\Entity\Other\ProductValue;
use AppBundle\Factory\Item\Base\ItemFactory;
use AppBundle\Manager\Decorator\Base\ItemDecorator;

class ProductCategoryAssignmentDecorator extends ItemDecorator {

	/**
	 *
	 * @var ItemFactory
	 */
	protected $productValueFactory;

	/**
	 *
	 * @var ItemDecorator
	 */
	protected $productValueDecorator;
	
	/**
	 *
	 * @var ItemFactory
	 */
	protected $productScoreFactory;

	/**
	 *
	 * @var ItemDecorator
	 */
	protected $productScoreDecorator;
	
	/**
	 *
	 * @var ItemFactory
	 */
	protected $productNoteFactory;
	
	/**
	 *
	 * @var ItemDecorator
	 */
	protected $productNoteDecorator;

	public function __construct(ItemFactory $productValueFactory, 
			ItemDecorator $productValueDecorator,
			ItemFactory $productScoreFactory,
			ItemDecorator $productScoreDecorator,
			ItemFactory $productNoteFactory,
			ItemDecorator $productNoteDecorator) {
		$this->productValueFactory = $productValueFactory;
		$this->productValueDecorator = $productValueDecorator;
		$this->productScoreFactory = $productScoreFactory;
		$this->productScoreDecorator = $productScoreDecorator;
		$this->productNoteFactory = $productNoteFactory;
		$this->productNoteDecorator = $productNoteDecorator;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Decorator\Base\ItemDecorator::getPrepared()
	 *
	 * @param ProductCategoryAssignment $item        	
	 */
	public function getPrepared($item) {
		if (! $item->getProductValue()) {
			$item->setProductValue($this->createProductValue($item));
		}
		if (! $item->getProductScore()) {
			$item->setProductScore($this->createProductScore($item));
		}
		if (! $item->getProductNote()) {
			$item->setProductNote($this->createProductNote($item));
		}
		
		return $item;
	}

	/**
	 *
	 * @param ProductCategoryAssignment $item        	
	 * @return \AppBundle\Entity\Other\ProductValue
	 */
	protected function createProductValue($item) {
		$result = $this->productValueFactory->create();
		$result->setProductCategoryAssignment($item);
		
		$result = $this->productValueDecorator->getPrepared($result);
		
		return $result;
	}

	/**
	 *
	 * @param ProductCategoryAssignment $item        	
	 * @return \AppBundle\Entity\Other\ProductScore
	 */
	protected function createProductScore($item) {
		$result = $this->productScoreFactory->create();
		$result->setProductCategoryAssignment($item);
		
		$result = $this->productScoreDecorator->getPrepared($result);
		
		return $result;
	}

	/**
	 *
	 * @param ProductCategoryAssignment $item        	
	 * @return \AppBundle\Entity\Other\ProductNote
	 */
	protected function createProductNote($item) {
		$result = $this->productNoteFactory->create();
		$result->setProductCategoryAssignment($item);
		
		$result = $this->productNoteDecorator->getPrepared($result);
		
		return $result;
	}
}