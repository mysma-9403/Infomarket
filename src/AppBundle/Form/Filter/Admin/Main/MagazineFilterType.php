<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\MagazineFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class MagazineFilterType extends SimpleEntityFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addEntityChoiceFilterField($builder, $options, 'parents');
		$this->addEntityChoiceFilterField($builder, $options, 'branches');
		$this->addEntityChoiceFilterField($builder, $options, 'categories');
		
		$this->addBooleanChoiceFilterField($builder, $options, 'featured');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('parents')] = [];
		$options[$this->getChoicesName('branches')] = [];
		$options[$this->getChoicesName('categories')] = [];
		
		$options[$this->getChoicesName('featured')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return MagazineFilter::class;
	}
}