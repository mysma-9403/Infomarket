<?php

namespace AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\CustomProductFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\FormBuilderInterface;

class CustomProductFilterType extends FilterType {
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		
		$this->addEntityChoiceFilterField($builder, $options, 'brands');
		$this->addEntityChoiceFilterField($builder, $options, 'categories');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('brands')] = [];
		$options[$this->getChoicesName('categories')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return CustomProductFilter::class;
	}
}