<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Manager\Params\Base\MenuParamsManager;

class IMMenuParamsManager extends MenuParamsManager {
	
	public function __construct($doctrine) {
		parent::__construct($doctrine);
		
		$this->infomarket = true;
	}
}