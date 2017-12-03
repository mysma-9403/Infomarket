<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\Segment;
use AppBundle\Factory\Item\Base\ItemFactory;

class SegmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Segment::class);
	}
}