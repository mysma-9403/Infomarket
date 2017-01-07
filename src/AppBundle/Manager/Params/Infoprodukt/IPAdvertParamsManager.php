<?php

namespace AppBundle\Manager\Params\Infoprodukt;

use AppBundle\Manager\Params\Base\AdvertParamsManager;

class IPAdvertParamsManager extends AdvertParamsManager {
	
	public function __construct($doctrine, array $advertLocations) {
		parent::__construct($doctrine, $advertLocations);
		
		$this->infoprodukt = true;
	}
}