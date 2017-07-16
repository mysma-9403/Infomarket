<?php

namespace AppBundle\Factory\Common\Choices;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Factory\Common\Choices\Base\AbstractChoicesFactory;

class BenchmarkFieldFieldTypesFactory extends AbstractChoicesFactory {
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Factory\Common\Choices\ChoicesFactory::getItems()
	 */
	public function getItems() {
		return [
				BenchmarkField::getFieldTypeName(BenchmarkField::DECIMAL_FIELD_TYPE) => BenchmarkField::DECIMAL_FIELD_TYPE,
				BenchmarkField::getFieldTypeName(BenchmarkField::INTEGER_FIELD_TYPE) => BenchmarkField::INTEGER_FIELD_TYPE,
				BenchmarkField::getFieldTypeName(BenchmarkField::BOOLEAN_FIELD_TYPE) => BenchmarkField::BOOLEAN_FIELD_TYPE,
				BenchmarkField::getFieldTypeName(BenchmarkField::STRING_FIELD_TYPE) => BenchmarkField::STRING_FIELD_TYPE,
				BenchmarkField::getFieldTypeName(BenchmarkField::SINGLE_ENUM_FIELD_TYPE) => BenchmarkField::SINGLE_ENUM_FIELD_TYPE,
				BenchmarkField::getFieldTypeName(BenchmarkField::MULTI_ENUM_FIELD_TYPE) => BenchmarkField::MULTI_ENUM_FIELD_TYPE
		];
	}
	
}