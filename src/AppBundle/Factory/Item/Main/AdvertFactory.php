<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\Advert;
use AppBundle\Factory\Item\Base\ItemFactory;

class AdvertFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Advert::class);
	}
}