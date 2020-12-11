<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\Magazine;
use AppBundle\Factory\Item\Base\ItemFactory;

class MagazineFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Magazine::class);
	}
}