<?php

namespace AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Utils\Entity\BenchmarkFieldUtils;
use AppBundle\Factory\Common\Chart\ChartFactory;
use AppBundle\Factory\Common\Chart\Data\ChartDataFactory;

class CategoryBenchmarkFieldFactory implements BenchmarkFieldFactory {

	/**
	 *
	 * @var BenchmarkFieldUtils
	 */
	private $benchmarkFieldUtils;

	/**
	 *
	 * @var ChartFactory
	 */
	private $chartFactory;

	/**
	 *
	 * @var ChartDataFactory
	 */
	private $booleanDataFactory;

	/**
	 *
	 * @var ChartDataFactory
	 */
	private $numberDataFactory;

	/**
	 *
	 * @var ChartDataFactory
	 */
	private $enumDataFactory;

	public function __construct(BenchmarkFieldUtils $benchmarkFieldUtils, ChartFactory $chartFactory, 
			ChartDataFactory $booleanDataFactory, ChartDataFactory $numberDataFactory, 
			ChartDataFactory $enumDataFactory) {
		$this->benchmarkFieldUtils = $benchmarkFieldUtils;
		$this->chartFactory = $chartFactory;
		$this->booleanDataFactory = $booleanDataFactory;
		$this->numberDataFactory = $numberDataFactory;
		$this->enumDataFactory = $enumDataFactory;
	}

	public function create(BenchmarkField $field) {
		switch ($field->getFieldType()) {
			case BenchmarkField::DECIMAL_FIELD_TYPE:
			case BenchmarkField::INTEGER_FIELD_TYPE:
				return $this->createNumberField($field);
			case BenchmarkField::BOOLEAN_FIELD_TYPE:
				return $this->createBooleanField($field);
			case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
			case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
				return $this->createEnumField($field);
			default:
				return $this->create($field);
		}
	}

	private function createNumberField(BenchmarkField $field) {
		$result = $this->createField($field);
		
		$result['decimalPlaces'] = $field->getDecimalPlaces();
		
		$distribution = $this->benchmarkFieldUtils->getDistributionArray($field);
		if (count($distribution) > 0) {
			$result['min'] = $this->benchmarkFieldUtils->getMin($field);
			$result['max'] = $this->benchmarkFieldUtils->getMax($field);
			$result['mean'] = $this->benchmarkFieldUtils->getMean($field);
			$result['mode'] = $this->benchmarkFieldUtils->getMode($field);
			$result['median'] = $this->benchmarkFieldUtils->getMedian($field);
			$result['chart'] = $this->createChart($field, $this->numberDataFactory, $distribution);
		} else {
			$result['min'] = 0;
			$result['max'] = 0;
			$result['mean'] = 0;
			$result['mode'] = 0;
			$result['median'] = 0;
			$result['chart'] = null;
		}
		
		return $result;
	}

	private function createBooleanField(BenchmarkField $field) {
		$result = $this->createField($field);
		
		$distribution = $this->benchmarkFieldUtils->getDistributionArray($field);
		if (count($distribution) > 0) {
			$trueCount = array_key_exists(1, $distribution) ? $distribution[1] : 0;
			$falseCount = array_key_exists(0, $distribution) ? $distribution[0] : 0;
			
			$result['count'] = $trueCount;
			$result['percent'] = 100 * $trueCount / ($trueCount + $falseCount);
			$result['chart'] = $this->createChart($field, $this->booleanDataFactory, $distribution);
		} else {
			$result['count'] = 0;
			$result['percent'] = 0;
			$result['chart'] = null;
		}
		
		return $result;
	}

	private function createEnumField(BenchmarkField $field) {
		$result = $this->createField($field);
		
		$distribution = $this->benchmarkFieldUtils->getDistributionArray($field);
		if (count($distribution) > 0) {
			$result['values'] = $this->benchmarkFieldUtils->getDistributionValuesString($field);
			$result['chart'] = $this->createChart($field, $this->enumDataFactory, $distribution);
		} else {
			$result['values'] = '';
			$result['chart'] = null;
		}
		
		return $result;
	}

	private function createField(BenchmarkField $field) {
		$result = [];
		
		$result['fieldName'] = $field->getFieldName();
		
		$result['fieldType'] = $field->getFieldType();
		$result['valueNumber'] = $field->getValueNumber();
		
		$result['valueField'] = $this->benchmarkFieldUtils->getValueField($field);
		
		return $result;
	}

	private function createChart(BenchmarkField $field, ChartDataFactory $dataFactory, $distribution) {
		$data = $dataFactory->create($field, $distribution);
		return $this->chartFactory->create($field->getFieldName(), $data);
	}
}