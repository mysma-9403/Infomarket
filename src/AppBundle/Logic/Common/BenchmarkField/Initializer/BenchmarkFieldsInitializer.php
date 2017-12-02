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

	public function init($fields) {
		$result = [];
		foreach ($fields as $field) {
			$result[] = $this->factory->create($field);
		}
		return $result;
	}
}