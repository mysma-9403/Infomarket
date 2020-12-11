<?php

namespace AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Utils\Entity\BenchmarkFieldUtils;

class FilterBenchmarkFieldFactory implements BenchmarkFieldFactory {

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
		
		$result['fieldType'] = $field->getFieldType();
		$result['filterName'] = $field->getFilterName();
		$result['featuredFilter'] = $field->getFeaturedFilter();
		$result['valueField'] = $this->benchmarkFieldUtils->getValueField($field);
		
		return $result;
	}
}