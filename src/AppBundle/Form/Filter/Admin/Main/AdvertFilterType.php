<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Entity\Main\Advert;
use AppBundle\Filter\Common\Main\AdvertFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class AdvertFilterType extends SimpleFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		
		$this->addFilterBooleanChoiceField($builder, $options, 'infomarket');
		$this->addFilterBooleanChoiceField($builder, $options, 'infoprodukt');
		
		$this->addFilterTextField($builder, 'link', 'label.advert.link');
		
		$this->addFilterEntityChoiceField($builder, $options, 'categories');
		$this->addFilterNumberChoiceField($builder, $options, 'locations');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('infomarket')] = [ ];
		$options[$this->getChoicesName('infoprodukt')] = [ ];
		
		$options[$this->getChoicesName('categories')] = [ ];
		$options[$this->getChoicesName('locations')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return AdvertFilter::class;
	}
}