<?php

namespace AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Benchmark\SubcategoryFilter;
use AppBundle\Form\Base\BaseType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class SubcategoryFilterType extends BaseType {
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addEntityChoiceFilterField($builder, $options, 'subcategory', true, false);
	}
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('submit', SubmitType::class);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[$this->getChoicesName('subcategory')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return SubcategoryFilter::class;
	}
}