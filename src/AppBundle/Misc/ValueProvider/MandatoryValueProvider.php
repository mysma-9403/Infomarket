<?php

namespace AppBundle\Misc\ValueProvider;

class MandatoryValueProvider implements ValueProvider {
	
	public function getValue(array $fields, $key) {
		if(!isset($fields[$key])) {
			throw new \InvalidArgumentException(sprintf("Field '%s' does not exist.", $key));
		}
		
		if(empty($fields[$key])) {
			throw new \InvalidArgumentException(sprintf("Field '%s' cannot be empty.", $key));
		}
		
		return $fields[$key];
	}
}