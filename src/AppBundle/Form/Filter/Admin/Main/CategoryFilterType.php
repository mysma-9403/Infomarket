<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\CategoryFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryFilterType extends SimpleFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		$this->addFilterTextField($builder, 'subname', 'label.subname');
		
		$this->addFilterBooleanChoiceField($builder, $options, 'infomarket');
		$this->addFilterBooleanChoiceField($builder, $options, 'infoprodukt');
		$this->addFilterBooleanChoiceField($builder, $options, 'featured');
		$this->addFilterBooleanChoiceField($builder, $options, 'preleaf');
		
		$this->addFilterEntityChoiceField($builder, $options, 'parents');
		$this->addFilterEntityChoiceField($builder, $options, 'branches');
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