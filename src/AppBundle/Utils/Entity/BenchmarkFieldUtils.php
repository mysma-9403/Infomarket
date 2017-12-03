<?php

namespace AppBundle\Utils\Entity;

use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use AppBundle\Entity\Main\BenchmarkField;

class BenchmarkFieldUtils {

	/**
	 *
	 * @var BenchmarkFieldDataBaseUtils
	 */
	protected $benchmarkFieldDataBaseUtils;

	public function __construct(BenchmarkFieldDataBaseUtils $benchmarkFieldDataBaseUtils) {
		$this->benchmarkFieldDataBaseUtils = $benchmarkFieldDataBaseUtils;
	}

	public function getValueField(BenchmarkField $field) {
		return $this->benchmarkFieldDataBaseUtils->getValueField($field);
	}
	
	public function getMin(BenchmarkField $field) {
		$offset = $this->benchmarkFieldDataBaseUtils->getMinField($field);
		return $field->getCategory()->getCategorySummary()->offsetGet($offset);
	}

	public function getMax(BenchmarkField $field) {
		$offset = $this->benchmarkFieldDataBaseUtils->getMaxField($field);
		return $field->getCategory()->getCategorySummary()->offsetGet($offset);
	}

	public function getMean(BenchmarkField $field) {
		$offset = $this->benchmarkFieldDataBaseUtils->getMeanField($field);
		return $field->getCategory()->getCategorySummary()->offsetGet($offset);
	}

	public function getMode(BenchmarkField $field) {
		$offset = $this->benchmarkFieldDataBaseUtils->getModeField($field);
		return $field->getCategory()->getCategorySummary()->offsetGet($offset);
	}

	public function getMedian(BenchmarkField $field) {
		$offset = $this->benchmarkFieldDataBaseUtils->getMedianField($field);
		return $field->getCategory()->getCategorySummary()->offsetGet($offset);
	}
}