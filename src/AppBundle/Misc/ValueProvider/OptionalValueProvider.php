<?php

namespace AppBundle\Misc\ValueProvider;

class OptionalValueProvider implements ValueProvider {
	
	public function getValue(array $fields, $key) {
		if(!isset($fields[$key]) || empty($fields[$key])) {
			return null;
		}
	
		return $fields[$key];
	}
}