<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\TermFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class TermFilterType extends SimpleFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		
		$this->addFilterBooleanChoiceField($builder, $options, 'infomarket');
		$this->addFilterBooleanChoiceField($builder, $options, 'infoprodukt');
		
		$this->addFilterEntityChoiceField($builder, $options, 'categories');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('infomarket')] = [];
		$options[$this->getChoicesName('infoprodukt')] = [];
		
		$options[$this->getChoicesName('categories')] = [];
		
		return $options;
	}

	protected function getEntityType() {
		return TermFilter::class;
	}
}