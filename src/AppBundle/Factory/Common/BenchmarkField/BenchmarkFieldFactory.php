<?php

namespace AppBundle\Factory\Common\BenchmarkField;

interface BenchmarkFieldFactory {

	public function create(array $properties, $categoryId);
}