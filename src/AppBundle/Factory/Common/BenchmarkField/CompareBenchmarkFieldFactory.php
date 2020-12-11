<?php

namespace AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Utils\Entity\BenchmarkFieldUtils;

class CompareBenchmarkFieldFactory implements BenchmarkFieldFactory {

	/**
	 *
	 * @var BenchmarkFieldUtils
	 */
	protected $benchmarkFieldUtils;

	public function __construct(BenchmarkFieldUtils $benchmarkFieldUtils) {
		$this->benchmarkFieldUtils = $benchmarkFieldUtils;
	}

	public function create(BenchmarkField $field) {
		$result = [];
		
		$result['fieldName'] = $field->getFieldName();
		$result['fieldType'] = $field->getFieldType();
		$result['showField'] = $field->getShowField();
		$result['decimalPlaces'] = $field->getDecimalPlaces();
		$result['nullReplacement'] = $field->getNullReplacement();
		$result['valueField'] = $this->benchmarkFieldUtils->getValueField($field);
		$result['compareWeight'] = $field->getCompareWeight();
		$result['betterThanType'] = $field->getBetterThanType();
		
		$result['min'] = $this->benchmarkFieldUtils->getMin($field);
		$result['max'] = $this->benchmarkFieldUtils->getMax($field);
		
		return $result;
	}
}