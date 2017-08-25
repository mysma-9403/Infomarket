<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\ArticleCategoryFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleCategoryFilterType extends SimpleEntityFilterType
{
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		parent::addMoreFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		$this->addFilterTextField($builder, 'subname', 'label.subname');
		
		$this->addBooleanChoiceFilterField($builder, $options, 'infomarket');
		$this->addBooleanChoiceFilterField($builder, $options, 'infoprodukt');
		$this->addBooleanChoiceFilterField($builder, $options, 'featured');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('infomarket')] = [];
		$options[$this->getChoicesName('infoprodukt')] = [];
		$options[$this->getChoicesName('featured')] = [];
		
		return $options;
	}
	
	protected function getEntityType() {
		return ArticleCategoryFilter::class;
	}
}