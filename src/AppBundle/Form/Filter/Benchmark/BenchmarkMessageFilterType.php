<?php

namespace AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\BenchmarkMessageFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkMessageFilterType extends FilterType {
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		
		$this->addEntityChoiceFilterField($builder, $options, 'products');
		$this->addNumberChoiceFilterField($builder, $options, 'states');
		$this->addBooleanChoiceFilterField($builder, $options, 'readByAuthor');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('products')] = [];
		$options[$this->getChoicesName('states')] = [];
		$options[$this->getChoicesName('readByAuthor')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return BenchmarkMessageFilter::class;
	}
}