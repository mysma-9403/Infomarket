<?php

namespace AppBundle\Factory\Item\Other;

use AppBundle\Entity\Other\CategorySummary;
use AppBundle\Factory\Item\Base\ItemFactory;

class CategorySummaryFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(CategorySummary::class);
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Factory\Item\Base\ItemFactory::create()
	 *
	 * @return CategorySummary
	 */
	public function create() {
		/** @var CategorySummary $item */
		$item = parent::create();
		$item->setUpToDate(false);
		
		return $item;
	}
}