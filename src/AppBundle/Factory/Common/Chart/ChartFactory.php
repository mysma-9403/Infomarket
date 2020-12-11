<?php

namespace AppBundle\Factory\Common\Chart;

interface ChartFactory {

	function create($title, array $data);
}