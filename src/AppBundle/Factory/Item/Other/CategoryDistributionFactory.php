<?php

namespace AppBundle\Factory\Item\Other;

use AppBundle\Entity\Other\CategoryDistribution;
use AppBundle\Factory\Item\Base\ItemFactory;

class CategoryDistributionFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(CategoryDistribution::class);
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Factory\Item\Base\ItemFactory::create()
	 *
	 * @return CategoryDistribution
	 */
	public function create() {
		/** @var CategoryDistribution $item */
		$item = parent::create();
		$item->setUpToDate(false);
		
		return $item;
	}
}