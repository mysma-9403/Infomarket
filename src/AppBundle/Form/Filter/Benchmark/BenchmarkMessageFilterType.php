<?php

namespace AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\BenchmarkMessageFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkMessageFilterType extends FilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		
		$this->addFilterEntityChoiceField($builder, $options, 'products');
		$this->addFilterNumberChoiceField($builder, $options, 'states');
		$this->addFilterBooleanChoiceField($builder, $options, 'readByAuthor');
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