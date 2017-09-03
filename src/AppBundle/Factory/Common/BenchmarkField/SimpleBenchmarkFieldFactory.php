<?php

namespace AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\Main\BenchmarkField;

class SimpleBenchmarkFieldFactory extends BenchmarkFieldFactoryBase {

	public function create(array $properties, $categoryId) {
		$properties = $this->initValueFieldProperty($properties);
		
		return $properties;
	}
}