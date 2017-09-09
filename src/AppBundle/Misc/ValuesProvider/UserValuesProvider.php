<?php

namespace AppBundle\Misc\ValuesProvider;

use AppBundle\Misc\ValueProvider\ValueProvider;

class UserValuesProvider extends SimpleValuesProvider {

	const ID_KEY = 'id';
	const PSEUDONYM_KEY = 'pseudonym';
	const SURNAME_KEY = 'surname';
	const FORENAME_KEY = 'forename';
	const USERNAME_KEY = 'username';
	
	public function __construct(ValueProvider $mandatoryValueProvider, ValueProvider $optionalValueProvider) {
		parent::__construct($mandatoryValueProvider, $optionalValueProvider, [self::ID_KEY]);
	}
	
	public function getValues(array $fields) {
		$filtered = parent::getValues($fields);
		
		$names = [];
		$this->addOptionalValue($names, $fields, 'pseudonym');
		
		if(empty($names)) {
			$this->addOptionalValue($names, $fields, 'surname');
			$this->addOptionalValue($names, $fields, 'forename');
		}
		
		if(empty($names)) {
			$this->addMandatoryValue($names, $fields, 'username');
		}
		
		return array_merge($filtered, $names);
	}
}