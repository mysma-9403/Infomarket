<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\CategoryFilter;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;

class CategoryFilterType extends SimpleEntityFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$builder
		->add('subname', TextType::class, array(
				'attr' => array(
						'placeholder' => 'label.subname'
				),
				'required' => false
		))
		;
		
		$this->addChoiceEntityFilterField($builder, $options, 'parents');
		$this->addChoiceEntityFilterField($builder, $options, 'branches');
		
		$this->addChoiceNumberFilterField($builder, $options, 'preleaf', false);
		$this->addChoiceNumberFilterField($builder, $options, 'featured', false);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('parents')] = [];
		$options[$this->getChoicesName('branches')] = [];
		
		$options[$this->getChoicesName('preleaf')] = [];
		$options[$this->getChoicesName('featured')] = [];
		$options[$this->getChoicesName('infomarket')] = [];
		$options[$this->getChoicesName('infoprodukt')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return CategoryFilter::class;
	}
}