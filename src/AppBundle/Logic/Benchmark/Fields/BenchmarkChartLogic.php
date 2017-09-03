<?php

namespace AppBundle\Logic\Benchmark\Fields;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;

class BenchmarkChartLogic {

	protected $translator;

	/**
	 *
	 * @var integer
	 */
	protected $chartWidth;

	/**
	 *
	 * @var integer
	 */
	protected $chartHeight;

	public function __construct($translator) {
		$this->translator = $translator;
		$this->chartWidth = 540;
		$this->chartHeight = 300;
	}

	public function initChartForBooleanField($field, $numOfProducts) {
		$trueCount = $field['count'];
		$falseCount = $numOfProducts - $trueCount;
		
		$yesLabel = $this->translator->trans('label.yes');
		$noLabel = $this->translator->trans('label.no');
		$label = $this->translator->trans('label.benchmark.numOfProducts');
		
		$array = [ [ '',$yesLabel,$noLabel 
		],[ $label,$trueCount,$falseCount 
		] 
		];
		
		$field['chart'] = $this->createColumnChart($field['fieldName'], $array);
		
		return $field;
	}

	public function initChartForNumberField($field) {
		$valueField = $field['valueField'];
		$valueCounts = $field['counts'];
		
		if (count($valueCounts) > 0) {
			$countLabel = $this->translator->trans('label.benchmark.numOfProducts');
			$array = [ [ 'label.value',$countLabel 
			] 
			];
			
			foreach ($valueCounts as $valueCount) {
				$array[] = [ number_format($valueCount[$valueField], $field['decimalPlaces']),
						$valueCount['vcount'] 
				];
			}
			
			$field['chart'] = $this->createColumnChart($field['fieldName'], $array);
		} else {
			$field['chart'] = null;
		}
		
		return $field;
	}

	public function initChartForEnumField($field) {
		$valueCounts = $field['valueCounts'];
		
		if (count($valueCounts) > 0) {
			$countLabel = $this->translator->trans('label.benchmark.numOfProducts');
			$array = [ [ 'label.value',$countLabel 
			] 
			];
			
			foreach ($valueCounts as $key => $value) {
				$array[] = [ $key,$value 
				];
			}
			
			$field['chart'] = $this->createColumnChart($field['fieldName'], $array);
		} else {
			$field['chart'] = null;
		}
		
		return $field;
	}

	protected function createColumnChart($title, $array) {
		$chart = new ColumnChart();
		
		$chart->getData()->setArrayToDataTable($array);
		
		$chart->getOptions()->setTitle($title)->setWidth($this->chartWidth)->setHeight($this->chartHeight);
		
		return $chart;
	}
}