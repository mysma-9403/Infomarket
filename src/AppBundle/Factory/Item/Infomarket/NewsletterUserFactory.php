<?php

namespace AppBundle\Factory\Item\Infomarket;

use AppBundle\Factory\Item\Main\NewsletterUserFactory as ParentFactory;
use AppBundle\Entity\Main\NewsletterUser;

class NewsletterUserFactory extends ParentFactory {
	
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
	
		$item->setInfomarket(true);
	
		return $item;
	}
}