<?php

namespace AppBundle\Factory\Item\Other;

use AppBundle\Entity\Other\ProductNote;
use AppBundle\Factory\Item\Base\ItemFactory;

class ProductNoteFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(ProductNote::class);
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Factory\Item\Base\ItemFactory::create()
	 *
	 * @return ProductNote
	 */
	public function create() {
		/** @var ProductNote $item */
		$item = parent::create();
		$item->setUpToDate(false);
		
		return $item;
	}
}