<?php

namespace AppBundle\Manager\Params\Infoprodukt;

use AppBundle\Manager\Params\Base\MenuParamsManager;

class IPMenuParamsManager extends MenuParamsManager {
	
	public function __construct($doctrine) {
		parent::__construct($doctrine);
		
		$this->infoprodukt = true;
	}
}