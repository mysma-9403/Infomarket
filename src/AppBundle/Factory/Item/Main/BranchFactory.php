<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\Branch;
use AppBundle\Factory\Item\Base\ItemFactory;

class BranchFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Branch::class);
	}
}