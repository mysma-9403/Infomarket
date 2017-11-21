<?php

namespace AppBundle\Logic\Common\BenchmarkField\Initializer;

use AppBundle\Factory\Common\BenchmarkField\BenchmarkFieldFactory;

class BenchmarkFieldsInitializer {

	/**
	 *
	 * @var BenchmarkFieldFactory
	 */
	protected $factory;

	public function __construct(BenchmarkFieldFactory $benchmarkFieldFactory) {
		$this->factory = $benchmarkFieldFactory;
	}

	public function init(array $fields) {
		for ($i = 0; $i < count($fields); $i ++) {
			$field = $fields[$i];
			$field = $this->factory->create($field);
			$fields[$i] = $field;
		}
		return $fields;
	}
}