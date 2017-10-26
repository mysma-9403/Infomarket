<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\Menu;
use AppBundle\Factory\Item\Base\ItemFactory;

class MenuFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Menu::class);
	}
}