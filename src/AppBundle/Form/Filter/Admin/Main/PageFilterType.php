<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\PageFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class PageFilterType extends SimpleEntityFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		
		$this->addBooleanChoiceFilterField($builder, $options, 'infomarket');
		$this->addBooleanChoiceFilterField($builder, $options, 'infoprodukt');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('infomarket')] = [];
		$options[$this->getChoicesName('infoprodukt')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return PageFilter::class;
	}
}