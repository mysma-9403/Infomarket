<?php

namespace AppBundle\Factory\Common\Choices\Enum;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Factory\Common\Choices\Base\TwigChoicesFactory;

class BenchmarkFieldFieldTypesFactory extends TwigChoicesFactory {
	
	public function __construct() {
		$this->items['label.benchmarkField.fieldType.decimal'] = BenchmarkField::DECIMAL_FIELD_TYPE;
		$this->items['label.benchmarkField.fieldType.integer'] = BenchmarkField::INTEGER_FIELD_TYPE;
		$this->items['label.benchmarkField.fieldType.boolean'] = BenchmarkField::BOOLEAN_FIELD_TYPE;
		$this->items['label.benchmarkField.fieldType.string'] = BenchmarkField::STRING_FIELD_TYPE;
		$this->items['label.benchmarkField.fieldType.singleEnum'] = BenchmarkField::SINGLE_ENUM_FIELD_TYPE;
		$this->items['label.benchmarkField.fieldType.multiEnum'] = BenchmarkField::MULTI_ENUM_FIELD_TYPE;
	}
	
	protected function getTwigFunctionName() {
		return 'benchmarkFieldFieldTypeName';
	}
}