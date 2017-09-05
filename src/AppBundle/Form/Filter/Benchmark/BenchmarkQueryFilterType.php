<?php

namespace AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Benchmark\BenchmarkQueryFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkQueryFilterType extends FilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
	}

	protected function getEntityType() {
		return BenchmarkQueryFilter::class;
	}
}