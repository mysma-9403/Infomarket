<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\Tag;
use AppBundle\Factory\Item\Base\ItemFactory;

class TagFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Tag::class);
	}
}