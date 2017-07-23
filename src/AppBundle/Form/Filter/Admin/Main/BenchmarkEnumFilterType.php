<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\BenchmarkEnumFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkEnumFilterType extends AdminFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$builder
		->add('name', TextType::class, array(
				'required' => false,
				'attr' => ['placeholder' => 'label.benchmarkEnum.name']
		))
		;
	}
	
	protected function getEntityType() {
		return BenchmarkEnumFilter::class;
	}
}