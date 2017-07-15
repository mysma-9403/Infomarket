<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BenchmarkFieldEditorType extends BaseEntityEditorType
{
	/**
	 * 
	 * @var EntityToNumberTransformer
	 */
	protected $categoryToNumberTransformer;
	
	public function __construct(EntityToNumberTransformer $categoryToNumberTransformer) {
		$this->categoryToNumberTransformer = $categoryToNumberTransformer;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$fieldType = $options['fieldType'];
		$noteType = $options['noteType'];
		$betterThanType = $options['betterThanType'];
		
		$builder
		->add('valueNumber', IntegerType::class, array(
				'required' => true,
				'attr' => ['placeholder' => 'label.benchmarkField.valueNumber']
		))
		->add('fieldNumber', IntegerType::class, array(
				'required' => false,
				'attr' => ['placeholder' => 'label.benchmarkField.fieldNumber']
		))
		->add('filterNumber', IntegerType::class, array(
				'required' => false,
				'attr' => ['placeholder' => 'label.benchmarkField.filterNumber']
		))
		
		->add('fieldName', TextType::class, array(
				'required' => false,
				'attr' => ['placeholder' => 'label.benchmarkField.fieldName']
		))
		->add('filterName', TextType::class, array(
				'required' => false,
				'attr' => ['placeholder' => 'label.benchmarkField.filterName']
		))
		
		->add('showField', CheckboxType::class, array(
				'required' => false
		))
		->add('showFilter', CheckboxType::class, array(
				'required' => false
		))
		
		->add('decimalPlaces', IntegerType::class, array(
				'required' => false,
				'attr' => ['placeholder' => 'label.benchmarkField.decimalPlaces']
		))
		
		->add('noteWeight', NumberType::class, array(
				'required' => false,
				'attr' => ['placeholder' => 'label.benchmarkField.noteWeight']
		))
		->add('compareWeight', NumberType::class, array(
				'required' => false,
				'attr' => ['placeholder' => 'label.benchmarkField.compareWeight']
		))
		
		->add('fieldType', ChoiceType::class, array(
				'choices'		=> $fieldType,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('noteType', ChoiceType::class, array(
				'choices'		=> $noteType,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('betterThanType', ChoiceType::class, array(
				'choices'		=> $betterThanType,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		;
		
		$this->addSingleChoiceField($builder, $options, $this->categoryToNumberTransformer, 'category');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options['category'] = [];
		$options['fieldType'] = [];
		$options['noteType'] = [];
		$options['betterThanType'] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return BenchmarkField::class;
	}
}