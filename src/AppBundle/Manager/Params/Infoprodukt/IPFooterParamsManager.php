<?php

namespace AppBundle\Manager\Params\Infoprodukt;

use AppBundle\Manager\Params\Base\FooterParamsManager;

class IPFooterParamsManager extends FooterParamsManager {
	
	public function __construct($doctrine) {
		parent::__construct($doctrine);
		
		$this->infoprodukt = true;
	}
}