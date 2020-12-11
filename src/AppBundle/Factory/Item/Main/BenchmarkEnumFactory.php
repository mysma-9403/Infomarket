<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\BenchmarkEnum;
use AppBundle\Factory\Item\Base\ItemFactory;

class BenchmarkEnumFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(BenchmarkEnum::class);
	}
}