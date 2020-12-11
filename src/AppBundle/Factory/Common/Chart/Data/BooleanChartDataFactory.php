<?php

namespace AppBundle\Factory\Common\Chart\Data;



use AppBundle\Entity\Main\BenchmarkField;

class BooleanChartDataFactory implements ChartDataFactory {

	/**
	 * 
	 * @var unknown
	 */
	protected $translator;
	
	
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
		$trueCount = array_key_exists(1, $distribution) ? $distribution[1] : 0;
		$falseCount = array_key_exists(0, $distribution) ? $distribution[0] : 0;
		
		$yesLabel = $this->translator->trans('label.yes');
		$noLabel = $this->translator->trans('label.no');
		
		$label = $this->translator->trans('label.benchmark.numOfProducts');
		
		return [['', $yesLabel, $noLabel], [$label, $trueCount, $falseCount]];
	}
}