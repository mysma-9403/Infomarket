<?php

namespace AppBundle\Misc\FormOptions\Lists;

use AppBundle\Utils\ParamUtils;

class ListFormOptionsProvider {
	
	public function getFormOptions(array $listItems) {
		$options = [];
		
		$options[ParamUtils::getChoicesName('entries')] = $listItems;
		
		return $options;
	}
}