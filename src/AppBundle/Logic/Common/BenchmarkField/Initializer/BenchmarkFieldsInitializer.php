<?php

namespace AppBundle\Logic\Common\BenchmarkField\Initializer;

interface BenchmarkFieldsInitializer {
	
	public function init(array $fields, $categoryId);
}