<?php

namespace AppBundle\Factory\Item\Other;

use AppBundle\Entity\Other\ProductScore;
use AppBundle\Factory\Item\Base\ItemFactory;

class ProductScoreFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(ProductScore::class);
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Factory\Item\Base\ItemFactory::create()
	 *
	 * @return ProductScore
	 */
	public function create() {
		/** @var ProductScore $item */
		$item = parent::create();
		$item->setUpToDate(false);
		
		return $item;
	}
}