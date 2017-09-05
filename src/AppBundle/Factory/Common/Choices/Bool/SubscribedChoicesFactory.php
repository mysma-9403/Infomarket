<?php

namespace AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Factory\Common\Choices\Base\SimpleChoicesFactory;
use AppBundle\Filter\Base\Filter;

class SubscribedChoicesFactory extends SimpleChoicesFactory {

	public function __construct() {
		$this->items['label.all'] = Filter::ALL_VALUES;
		$this->items['label.newsletter.subscribed'] = Filter::TRUE_VALUES;
		$this->items['label.newsletter.unsubscribed'] = Filter::FALSE_VALUES;
	}
}