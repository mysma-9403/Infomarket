<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Entity\Advert;
use AppBundle\Filter\Admin\Main\AdvertFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class AdvertFilterType extends SimpleEntityFilterType
{	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		
		$this->addBooleanChoiceFilterField($builder, $options, 'infomarket');
		$this->addBooleanChoiceFilterField($builder, $options, 'infoprodukt');
		
		$this->addFilterTextField($builder, 'link', 'label.advert.link');
		
		$this->addEntityChoiceFilterField($builder, $options, 'categories');
		$this->addNumberChoiceFilterField($builder, $options, 'locations');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('infomarket')] = [];
		$options[$this->getChoicesName('infoprodukt')] = [];
		
		$options[$this->getChoicesName('categories')] = [];
		$options[$this->getChoicesName('locations')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return AdvertFilter::class;
	}
}