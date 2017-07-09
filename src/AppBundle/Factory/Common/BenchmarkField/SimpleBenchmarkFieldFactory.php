<?php

namespace AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\BenchmarkField;

class SimpleBenchmarkFieldFactory extends BenchmarkFieldFactoryBase {
	
	public function create(array $properties, $categoryId) {
		$properties = $this->initValueFieldProperty($properties);
		
		return $properties;
	}
}