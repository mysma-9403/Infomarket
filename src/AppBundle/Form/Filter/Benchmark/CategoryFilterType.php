<?php

namespace AppBundle\Form\Filter\Benchmark;

use AppBundle\Entity\Category;
use AppBundle\Filter\Benchmark\CategoryFilter;
use AppBundle\Form\Base\BaseType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryFilterType extends BaseType {
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addEntityChoiceFilterField($builder, $options, 'category', true, false);
	}
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('submit', SubmitType::class);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[$this->getChoicesName('category')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return CategoryFilter::class;
	}
}