<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\BenchmarkQuery;
use AppBundle\Factory\Item\Base\ItemFactory;

class BenchmarkQueryFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(BenchmarkQuery::class);
	}
}