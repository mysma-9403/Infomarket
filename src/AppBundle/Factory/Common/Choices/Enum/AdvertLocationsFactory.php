<?php

namespace AppBundle\Factory\Common\Choices\Enum;

use AppBundle\Entity\Advert;
use AppBundle\Factory\Common\Choices\Base\TwigChoicesFactory;

class AdvertLocationsFactory extends TwigChoicesFactory {
	
	public function __construct() {
		$this->items['label.advert.location.top'] = Advert::TOP_LOCATION;
		$this->items['label.advert.location.side'] = Advert::SIDE_LOCATION;
		$this->items['label.advert.location.text'] = Advert::TEXT_LOCATION;
		$this->items['label.advert.location.featured'] = Advert::FEATURED_LOCATION;
	}
	
	protected function getTwigFunctionName() {
		return 'advertLocationName';
	}
}