<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\NewsletterBlock;
use AppBundle\Factory\Item\Base\ItemFactory;

class NewsletterBlockFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(NewsletterBlock::class);
	}
}