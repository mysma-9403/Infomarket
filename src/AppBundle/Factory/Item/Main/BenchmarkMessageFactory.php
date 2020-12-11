<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\BenchmarkMessage;
use AppBundle\Factory\Item\Base\ItemFactory;

class BenchmarkMessageFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(BenchmarkMessage::class);
	}
}