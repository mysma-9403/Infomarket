<?php

namespace AppBundle\Factory\Common\Choices;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Factory\Common\Choices\Base\AbstractChoicesFactory;

class BenchmarkFieldBetterThanTypesFactory extends AbstractChoicesFactory {
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Factory\Common\Choices\ChoicesFactory::getItems()
	 */
	public function getItems() {
		return [
				BenchmarkField::getBetterThanTypeName(BenchmarkField::NONE_BETTER_THAN_TYPE) => BenchmarkField::NONE_BETTER_THAN_TYPE,
				BenchmarkField::getBetterThanTypeName(BenchmarkField::LT_BETTER_THAN_TYPE) => BenchmarkField::LT_BETTER_THAN_TYPE,
				BenchmarkField::getBetterThanTypeName(BenchmarkField::LTE_BETTER_THAN_TYPE) => BenchmarkField::LTE_BETTER_THAN_TYPE,
				BenchmarkField::getBetterThanTypeName(BenchmarkField::GT_BETTER_THAN_TYPE) => BenchmarkField::GT_BETTER_THAN_TYPE,
				BenchmarkField::getBetterThanTypeName(BenchmarkField::GTE_BETTER_THAN_TYPE) => BenchmarkField::GTE_BETTER_THAN_TYPE,
				BenchmarkField::getBetterThanTypeName(BenchmarkField::EQUAL_BETTER_THAN_TYPE) => BenchmarkField::EQUAL_BETTER_THAN_TYPE
		];
	}
	
}