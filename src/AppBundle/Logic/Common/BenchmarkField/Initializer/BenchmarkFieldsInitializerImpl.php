<?php

namespace AppBundle\Logic\Common\BenchmarkField\Initializer;

use AppBundle\Factory\Common\BenchmarkField\BenchmarkFieldFactory;

class BenchmarkFieldsInitializerImpl implements BenchmarkFieldsInitializer {

	/**
	 *
	 * @var BenchmarkFieldFactory
	 */
	protected $factory;

	public function __construct(BenchmarkFieldFactory $benchmarkFieldFactory) {
		$this->factory = $benchmarkFieldFactory;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializer::init()
	 */
	public function init(array $fields, $categoryId) {
		for ($i = 0; $i < count($fields); $i ++) {
			$field = $fields[$i];
			$field = $this->factory->create($field, $categoryId);
			$fields[$i] = $field;
		}
		return $fields;
	}
}