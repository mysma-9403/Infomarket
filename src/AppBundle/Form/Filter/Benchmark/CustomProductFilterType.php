<?php

namespace AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\CustomProductFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use AppBundle\Utils\FormUtils;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class CustomProductFilterType extends SimpleEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$brands = $options['brands'];
		$categories = $options['categories'];
		
		$builder
		->add('brands', ChoiceType::class, array(
				'choices'		=> $brands,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('categories', ChoiceType::class, array(
				'choices'		=> $categories, 
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['brands'] = array();
		$options['categories'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return CustomProductFilter::class;
	}
}