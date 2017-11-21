<?php

namespace AppBundle\Factory\Common\Chart;

use AppBundle\Factory\Common\Chart\ChartFactory;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;

class ColumnChartFactory implements ChartFactory {

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

	public function __construct($chartWidth, $chartHeight) {
		$this->chartWidth = $chartWidth;
		$this->chartHeight = $chartHeight;
	}

	public function create($title, array $data) {
		$chart = new ColumnChart();
		
		$chart->getData()->setArrayToDataTable($data);
		
		$chart->getOptions()->setTitle($title)->setWidth($this->chartWidth)->setHeight($this->chartHeight);
		
		return $chart;
	}
}