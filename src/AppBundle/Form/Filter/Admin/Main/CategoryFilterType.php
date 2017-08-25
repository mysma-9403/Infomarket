<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\CategoryFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryFilterType extends SimpleEntityFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		$this->addFilterTextField($builder, 'subname', 'label.subname');
		
		$this->addBooleanChoiceFilterField($builder, $options, 'infomarket');
		$this->addBooleanChoiceFilterField($builder, $options, 'infoprodukt');
		$this->addBooleanChoiceFilterField($builder, $options, 'featured');
		$this->addBooleanChoiceFilterField($builder, $options, 'preleaf');
		
		$this->addEntityChoiceFilterField($builder, $options, 'parents');
		$this->addEntityChoiceFilterField($builder, $options, 'branches');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('infomarket')] = [];
		$options[$this->getChoicesName('infoprodukt')] = [];
		$options[$this->getChoicesName('featured')] = [];
		$options[$this->getChoicesName('preleaf')] = [];
		
		$options[$this->getChoicesName('parents')] = [];
		$options[$this->getChoicesName('branches')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return CategoryFilter::class;
	}
}