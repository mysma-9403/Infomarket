<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\MenuEntryFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryFilterType extends SimpleFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		
		$this->addFilterBooleanChoiceField($builder, $options, 'infomarket');
		$this->addFilterBooleanChoiceField($builder, $options, 'infoprodukt');
		
		$this->addFilterEntityChoiceField($builder, $options, 'menus');
		$this->addFilterEntityChoiceField($builder, $options, 'parents');
		$this->addFilterEntityChoiceField($builder, $options, 'branches');
		$this->addFilterEntityChoiceField($builder, $options, 'categories');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('infomarket')] = [];
		$options[$this->getChoicesName('infoprodukt')] = [];
		
		$options[$this->getChoicesName('menus')] = [];
		$options[$this->getChoicesName('parents')] = [];
		$options[$this->getChoicesName('branches')] = [];
		$options[$this->getChoicesName('categories')] = [];
		
		return $options;
	}

	protected function getEntityType() {
		return MenuEntryFilter::class;
	}
}