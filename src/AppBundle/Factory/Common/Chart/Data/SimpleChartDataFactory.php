<?php

namespace AppBundle\Factory\Common\Chart\Data;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Factory\Common\Chart\Data\ChartDataFactory;

class SimpleChartDataFactory implements ChartDataFactory {

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
			$data[] = [$key, $value];
		}
		
		return $data;
	}
}