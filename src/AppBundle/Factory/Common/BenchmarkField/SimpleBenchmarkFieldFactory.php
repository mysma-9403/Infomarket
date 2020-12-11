<?php

namespace AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Utils\Entity\BenchmarkFieldUtils;

class SimpleBenchmarkFieldFactory implements BenchmarkFieldFactory {

	/**
	 *
	 * @var BenchmarkFieldUtils
	 */
	private $benchmarkFieldUtils;
	
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
		
		return $result;
	}
}