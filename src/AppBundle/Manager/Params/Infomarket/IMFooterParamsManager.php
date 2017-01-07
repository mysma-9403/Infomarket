<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Manager\Params\Base\FooterParamsManager;

class IMFooterParamsManager extends FooterParamsManager {
	
	public function __construct($doctrine) {
		parent::__construct($doctrine);
		
		$this->infomarket = true;
	}
}