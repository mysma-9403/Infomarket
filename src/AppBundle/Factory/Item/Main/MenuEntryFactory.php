<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\MenuEntry;
use AppBundle\Factory\Item\Base\ItemFactory;

class MenuEntryFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(MenuEntry::class);
	}
}