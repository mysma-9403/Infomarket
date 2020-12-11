<?php

namespace AppBundle\Factory\Common\Chart\Data;

use AppBundle\Factory\Common\Chart\Data\ChartDataFactory;
use AppBundle\Entity\Main\BenchmarkField;

class NumberChartDataFactory implements ChartDataFactory {

	private $translator;
	
	public function __construct($translator) {
		$this->translator = $translator;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Factory\Common\Chart\Data\ChartDataFactory::create()
	 */
	public function create(BenchmarkField $field, array $distribution) {
		$countLabel = $this->translator->trans('label.benchmark.numOfProducts');
		$data = [['label.value', $countLabel]];
		
		foreach ($distribution as $key => $value) {
			$data[] = [number_format($key, $field->getDecimalPlaces()), $value];
		}
		
		return $data;
	}
}