<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\Link;
use AppBundle\Factory\Item\Base\ItemFactory;

class LinkFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Link::class);
	}
}