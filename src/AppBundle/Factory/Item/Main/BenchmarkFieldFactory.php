<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Factory\Item\Base\ItemFactory;

class BenchmarkFieldFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(BenchmarkField::class);
	}
}