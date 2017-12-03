<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\NewsletterUser;
use AppBundle\Factory\Item\Base\ItemFactory;

class NewsletterUserFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(NewsletterUser::class);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Factory\Item\Base\ItemFactory::create()
	 * 
	 * @return NewsletterUser
	 */
	public function create() {
		$item = parent::create();
		/** @var NewsletterUser $item */
		
		$item->setInfomarket(false);
		$item->setInfoprodukt(false);
		
		return $item;
	}
}