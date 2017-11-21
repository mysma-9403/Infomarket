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
		return $field->getCategory()->getCategoryDistribution()->offsetGet($offset);
	}

	public function getMode(BenchmarkField $field) {
		$offset = $this->benchmarkFieldDataBaseUtils->getModeField($field);
		return $field->getCategory()->getCategoryDistribution()->offsetGet($offset);
	}

	public function getMedian(BenchmarkField $field) {
		$offset = $this->benchmarkFieldDataBaseUtils->getMedianField($field);
		return $field->getCategory()->getCategoryDistribution()->offsetGet($offset);
	}

	public function getDistributionString(BenchmarkField $field) {
		$offset = $this->benchmarkFieldDataBaseUtils->getDistributionField($field);
		return $field->getCategory()->getCategoryDistribution()->offsetGet($offset);
	}

	public function getDistributionArray(BenchmarkField $field) {
		$result = [];
		
		$string = $this->getDistributionString($field);
		if ($string) {
			$pairs = explode(";", $string);
			foreach ($pairs as $pair) {
				$keyValue = explode(":", $pair);
				if (count($keyValue) == 2) {
					$result[$keyValue[0]] = (int) $keyValue[1];
				}
			}
		}
		
		return $result;
	}

	public function getDistributionValuesString(BenchmarkField $field) {
		$values = $this->getDistributionArray($field);
		return join(", ", array_keys($values));
	}
}