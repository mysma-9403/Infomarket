<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\Page;
use AppBundle\Factory\Item\Base\ItemFactory;

class PageFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Page::class);
	}
}