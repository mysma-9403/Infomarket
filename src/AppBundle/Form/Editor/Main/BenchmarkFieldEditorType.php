<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Form\Editor\Transformer\CategoryToNumberTransformer;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BenchmarkFieldEditorType extends BaseEntityEditorType
{
	protected $em;
	
	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = $this->em->getRepository(Category::class);
		$categories = $categoryRepository->findFilterItems();
		
		$fieldTypes = array(
				'label.benchmarkField.fieldType.decimal'	=> BenchmarkField::DECIMAL_FIELD_TYPE,
				'label.benchmarkField.fieldType.integer'	=> BenchmarkField::INTEGER_FIELD_TYPE,
				'label.benchmarkField.fieldType.boolean'	=> BenchmarkField::BOOLEAN_FIELD_TYPE,
				'label.benchmarkField.fieldType.string'		=> BenchmarkField::STRING_FIELD_TYPE,
				'label.benchmarkField.fieldType.singleEnum'	=> BenchmarkField::SINGLE_ENUM_FIELD_TYPE,
				'label.benchmarkField.fieldType.multiEnum'	=> BenchmarkField::MULTI_ENUM_FIELD_TYPE
		);
		
		$builder
		->add('category', ChoiceType::class, array(
				'choices' 		=> $categories,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('fieldType', ChoiceType::class, array(
				'choices'		=> $fieldTypes,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('valueNumber', NumberType::class, array(
				'required' => true,
				'attr' => ['placeholder' => 'label.benchmarkField.valueNumber']
		))
		->add('fieldNumber', NumberType::class, array(
				'required' => false,
				'attr' => ['placeholder' => 'label.benchmarkField.fieldNumber']
		))
		->add('filterNumber', NumberType::class, array(
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
		->add('decimalPlaces', NumberType::class, array(
				'required' => false,
				'attr' => ['placeholder' => 'label.benchmarkField.decimalPlaces']
		))
		;
		
		$builder->get('category')->addModelTransformer(new CategoryToNumberTransformer($this->em));
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