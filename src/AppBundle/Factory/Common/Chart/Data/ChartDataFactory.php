<?php

namespace AppBundle\Factory\Common\Chart\Data;

use AppBundle\Entity\Main\BenchmarkField;

interface ChartDataFactory {
	
	function create(BenchmarkField $field, array $distribution);
}