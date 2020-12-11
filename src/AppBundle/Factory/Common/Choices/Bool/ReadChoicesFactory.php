<?php

namespace AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Factory\Common\Choices\Base\SimpleChoicesFactory;
use AppBundle\Filter\Base\Filter;

class ReadChoicesFactory extends SimpleChoicesFactory {

	public function __construct() {
		$this->items['label.all'] = Filter::ALL_VALUES;
		$this->items['label.read'] = Filter::TRUE_VALUES;
		$this->items['label.unread'] = Filter::FALSE_VALUES;
	}
}