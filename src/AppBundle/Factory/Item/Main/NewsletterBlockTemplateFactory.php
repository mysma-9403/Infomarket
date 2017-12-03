<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\NewsletterBlockTemplate;
use AppBundle\Factory\Item\Base\ItemFactory;

class NewsletterBlockTemplateFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(NewsletterBlockTemplate::class);
	}
}