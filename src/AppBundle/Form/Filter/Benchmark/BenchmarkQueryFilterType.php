<?php

namespace AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Benchmark\BenchmarkQueryFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkQueryFilterType extends AdminFilterType {
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$builder
		->add('name', TextType::class, array(
				'required'		=> false
		))
		;
	}
	
	protected function getEntityType() {
		return BenchmarkQueryFilter::class;
	}
}