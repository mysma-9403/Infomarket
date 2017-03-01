<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Filter\Admin\Main\BenchmarkFieldFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use AppBundle\Utils\FormUtils;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkFieldFilterType extends AdminFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$categories = $options['categories'];
		
		$fieldTypes = array(
				'label.benchmarkField.fieldType.decimal'	=> BenchmarkField::DECIMAL_FIELD_TYPE,
				'label.benchmarkField.fieldType.integer'	=> BenchmarkField::INTEGER_FIELD_TYPE,
				'label.benchmarkField.fieldType.boolean'	=> BenchmarkField::BOOLEAN_FIELD_TYPE,
				'label.benchmarkField.fieldType.string'		=> BenchmarkField::STRING_FIELD_TYPE,
				'label.benchmarkField.fieldType.enum'		=> BenchmarkField::ENUM_FIELD_TYPE
		);
		
		$builder
		->add('categories', ChoiceType::class, array(
				'choices'		=> $categories, 
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('fieldTypes', ChoiceType::class, array(
				'choices'		=> $fieldTypes,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('fieldName', TextType::class, array(
				'required' => false,
				'attr' => ['placeholder' => 'label.benchmarkField.fieldName']
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['categories'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return BenchmarkFieldFilter::class;
	}
}