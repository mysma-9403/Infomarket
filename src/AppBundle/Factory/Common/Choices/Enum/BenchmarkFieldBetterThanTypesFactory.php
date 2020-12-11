<?php

namespace AppBundle\Factory\Common\Choices\Enum;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Factory\Common\Choices\Base\TwigChoicesFactory;

class BenchmarkFieldBetterThanTypesFactory extends TwigChoicesFactory {

	public function __construct() {
		$this->items['label.benchmarkField.betterThanType.none'] = BenchmarkField::NONE_BETTER_THAN_TYPE;
		$this->items['label.benchmarkField.betterThanType.lesserThan'] = BenchmarkField::LT_BETTER_THAN_TYPE;
		$this->items['label.benchmarkField.betterThanType.greaterThan'] = BenchmarkField::GT_BETTER_THAN_TYPE;
	}

	protected function getTwigFunctionName() {
		return 'benchmarkFieldBetterThanTypeName';
	}
}