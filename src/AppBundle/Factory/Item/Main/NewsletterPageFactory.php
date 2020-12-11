<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\NewsletterPage;
use AppBundle\Factory\Item\Base\ItemFactory;

class NewsletterPageFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(NewsletterPage::class);
	}
}