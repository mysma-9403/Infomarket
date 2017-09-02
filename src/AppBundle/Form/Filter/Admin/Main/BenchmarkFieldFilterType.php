<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Filter\Common\Main\BenchmarkFieldFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkFieldFilterType extends SimpleEntityFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'fieldName', 'label.benchmarkField.fieldName');
		
		$this->addFilterEntityChoiceField($builder, $options, 'categories');
		$this->addFilterNumberChoiceField($builder, $options, 'fieldTypes');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('categories')] = [ ];
		$options[$this->getChoicesName('fieldTypes')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return BenchmarkFieldFilter::class;
	}
}