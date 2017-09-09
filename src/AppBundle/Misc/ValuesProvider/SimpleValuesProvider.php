<?php

namespace AppBundle\Misc\ValuesProvider;

use AppBundle\Misc\ValueProvider\ValueProvider;

class SimpleValuesProvider extends ValuesProvider {

	/**
	 *
	 * @var array
	 */
	protected $mandatoryKeys;

	/**
	 *
	 * @var array
	 */
	protected $optionalKeys;

	public function __construct(ValueProvider $mandatoryValueProvider, ValueProvider $optionalValueProvider, 
			array $mandatoryKeys, array $optionalKeys = []) {
		parent::__construct($mandatoryValueProvider, $optionalValueProvider);
		
		$this->mandatoryKeys = $mandatoryKeys;
		$this->optionalKeys = $optionalKeys;
	}

	public function getValues(array $fields) {
		$filtered = [];
		
		foreach ($this->mandatoryKeys as $key) {
			$this->addMandatoryValue($filtered, $fields, $key);
		}
		
		foreach ($this->optionalKeys as $key) {
			$this->addOptionalValue($filtered, $fields, $key);
		}
		
		return $filtered;
	}
}