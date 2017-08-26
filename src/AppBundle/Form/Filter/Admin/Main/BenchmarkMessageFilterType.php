<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\BenchmarkMessageFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkMessageFilterType extends SimpleEntityFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'products');
		$this->addFilterEntityChoiceField($builder, $options, 'authors');
		
		$this->addFilterNumberChoiceField($builder, $options, 'states');
		$this->addFilterBooleanChoiceField($builder, $options, 'readByAdmin');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('products')] = [ ];
		$options[$this->getChoicesName('authors')] = [ ];
		
		$options[$this->getChoicesName('states')] = [ ];
		$options[$this->getChoicesName('readByAdmin')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return BenchmarkMessageFilter::class;
	}
}