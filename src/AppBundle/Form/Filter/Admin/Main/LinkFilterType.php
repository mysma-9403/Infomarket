<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\LinkFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class LinkFilterType extends SimpleEntityFilterType
{
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		parent::addMoreFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		
		$this->addBooleanChoiceFilterField($builder, $options, 'infomarket');
		$this->addBooleanChoiceFilterField($builder, $options, 'infoprodukt');
		
		$this->addFilterTextField($builder, 'url', 'label.url');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[$this->getChoicesName('infomarket')] = [];
		$options[$this->getChoicesName('infoprodukt')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return LinkFilter::class;
	}
}