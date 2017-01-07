<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Manager\Params\Base\AdvertParamsManager;

class IMAdvertParamsManager extends AdvertParamsManager {
	
	public function __construct($doctrine, array $advertLocations) {
		parent::__construct($doctrine, $advertLocations);
		
		$this->infomarket = true;
	}
}