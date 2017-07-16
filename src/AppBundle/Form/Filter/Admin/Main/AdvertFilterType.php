<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Entity\Advert;
use AppBundle\Filter\Admin\Main\AdvertFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AdvertFilterType extends SimpleEntityFilterType
{	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$builder
		->add('link', TextType::class, array(
				'attr' => array(
						'placeholder' => 'label.advert.link'
				),
				'required' => false
		))
		;
		
		$this->addChoiceEntityFilterField($builder, $options, 'categories');
		$this->addChoiceNumberFilterField($builder, $options, 'locations');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('categories')] = [];
		$options[$this->getChoicesName('locations')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return AdvertFilter::class;
	}
}