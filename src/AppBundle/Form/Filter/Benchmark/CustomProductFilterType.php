<?php

namespace AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\CustomProductFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\FormBuilderInterface;

class CustomProductFilterType extends FilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		
		$this->addFilterEntityChoiceField($builder, $options, 'brands');
		$this->addFilterEntityChoiceField($builder, $options, 'categories');
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