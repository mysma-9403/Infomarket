<?php

namespace AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Benchmark\BenchmarkQueryFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkQueryFilterType extends FilterType {
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
	}
	
	protected function getEntityType() {
		return BenchmarkQueryFilter::class;
	}
}