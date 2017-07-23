<?php

namespace AppBundle\Form\FormBuilder;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Factory\Common\Name\NameFactory;
use AppBundle\Utils\StringUtils;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkFilterFieldBuilder implements FormBuilder {
	
	/**
	 * 
	 * @var NameFactory
	 */
	protected $choicesStringFactory;
	
	public function __construct(NameFactory $choicesStringFactory) {
		$this->choicesStringFactory = $choicesStringFactory;
	}
	
	//TODO use some builder utility --> FieldBuilder
	public function add(FormBuilderInterface &$builder, array $params, $options) {
		$filterName = $params['filterName'];
		$fieldType = $params['fieldType'];
		$valueField = $params['valueField'];
		
		$choices = $options['choices'];
		$booleanChoices = $options[$this->choicesStringFactory->getName('boolean')];
		
		switch($fieldType) {
				case BenchmarkField::DECIMAL_FIELD_TYPE:
					$builder->add(StringUtils::getCleanName($filterName) . '_min', NumberType::class, array(
							'attr' => ['placeholder' => $filterName . ' (min)'],
							'required' => false
					));
					$builder->add(StringUtils::getCleanName($filterName) . '_max', NumberType::class, array(
							'attr' => ['placeholder' => $filterName . ' (max)'],
							'required' => false
					));
					break;
				case BenchmarkField::INTEGER_FIELD_TYPE:
					$builder->add(StringUtils::getCleanName($filterName) . '_min', IntegerType::class, array(
						'attr' => ['placeholder' => $filterName . ' (min)'],
						'required' => false
					));
					$builder->add(StringUtils::getCleanName($filterName) . '_max', IntegerType::class, array(
						'attr' => ['placeholder' => $filterName . ' (max)'],
						'required' => false
					));
					break;
				case BenchmarkField::BOOLEAN_FIELD_TYPE:
					$builder->add(StringUtils::getCleanName($filterName), ChoiceType::class, array(
							'choices'		=> $booleanChoices,
							'required'		=> true,
							'expanded'      => false,
							'multiple'      => false
					));
					break;
				case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
				case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
					$builder->add(StringUtils::getCleanName($filterName), ChoiceType::class, array(
						'choices'		=> $choices[$valueField],
						'choice_label' => function ($value, $key, $index) { return $value; },
						'choice_translation_domain' => false,
						'required'		=> false,
						'expanded'      => false,
						'multiple'      => true
					));
					break;
				default:
					$builder->add(StringUtils::getCleanName($filterName), null, array(
						'attr' => ['placeholder' => $filterName],
						'required' => false
					));
					break;
			}
	}
}