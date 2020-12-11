<?php

namespace AppBundle\Misc\ValuesProvider;

use AppBundle\Misc\ValueProvider\ValueProvider;

abstract class ValuesProvider {

	/**
	 *
	 * @var ValueProvider
	 */
	protected $mandatoryValueProvider;

	/**
	 *
	 * @var ValueProvider
	 */
	protected $optionalValueProvider;

	public function __construct(ValueProvider $mandatoryValueProvider, ValueProvider $optionalValueProvider) {
		$this->mandatoryValueProvider = $mandatoryValueProvider;
		$this->optionalValueProvider = $optionalValueProvider;
	}

	public abstract function getValues(array $fields);

	protected function addMandatoryValue(array &$filtered, array $fields, $key) {
		$filtered[] = $this->mandatoryValueProvider->getValue($fields, $key);
	}

	protected function addOptionalValue(array &$filtered, array $fields, $key) {
		$value = $this->optionalValueProvider->getValue($fields, $key);
		if (isset($value) && ! empty($value)) {
			$filtered[] = $value;
		}
	}
}