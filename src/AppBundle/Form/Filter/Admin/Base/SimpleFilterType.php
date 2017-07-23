<?php

namespace AppBundle\Form\Filter\Admin\Base;

use AppBundle\Filter\Admin\Base\SimpleFilter;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleFilterType extends AdminFilterType //TODO change hierarchy Simple -> this or remove like featured
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
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
		return SimpleFilter::class;
	}
}