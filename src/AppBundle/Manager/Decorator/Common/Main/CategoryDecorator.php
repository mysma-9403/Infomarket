<?php

namespace AppBundle\Manager\Decorator\Common\Main;

use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Other\CategorySummary;
use AppBundle\Factory\Common\Image\UploadedFileInfoFactory;
use AppBundle\Factory\Item\Base\ItemFactory;
use AppBundle\Manager\Decorator\Base\ItemDecorator;
use AppBundle\Manager\Decorator\Common\Base\ImageDecorator;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;

class CategoryDecorator extends ImageDecorator {

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

	public function __construct(UploadableManager $uploadableManager, 
			UploadedFileInfoFactory $uploadedFileInfoFactory, ItemFactory $categorySummaryFactory, 
			ItemDecorator $categorySummaryDecorator) {
		parent::__construct($uploadableManager, $uploadedFileInfoFactory);
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
		$item = parent::getPrepared($item);
		
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