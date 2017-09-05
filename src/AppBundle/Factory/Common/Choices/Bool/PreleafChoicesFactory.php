<?php

namespace AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Factory\Common\Choices\Base\SimpleChoicesFactory;
use AppBundle\Filter\Base\Filter;

class PreleafChoicesFactory extends SimpleChoicesFactory {

	public function __construct() {
		$this->items['label.all'] = Filter::ALL_VALUES;
		$this->items['label.category.preleaf'] = Filter::TRUE_VALUES;
		$this->items['label.category.notPreleaf'] = Filter::FALSE_VALUES;
	}
}