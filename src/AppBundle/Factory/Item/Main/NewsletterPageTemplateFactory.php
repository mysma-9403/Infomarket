<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\NewsletterPageTemplate;
use AppBundle\Factory\Item\Base\ItemFactory;

class NewsletterPageTemplateFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(NewsletterPageTemplate::class);
	}
}