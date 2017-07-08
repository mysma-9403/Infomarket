<?php

namespace AppBundle\Form\Editor\Common;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Product;
use AppBundle\Filter\Common\Other\ProductFilter;
use AppBundle\Form\Editor\Base\ImageEntityEditorType;
use AppBundle\Form\Editor\Transformer\BrandToNumberTransformer;
use AppBundle\Form\Editor\Transformer\IntegerToBooleanTransformer;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductEditorType extends ImageEntityEditorType
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
		
		/** @var BrandRepository $brandRepository */
		$brandRepository = $this->em->getRepository(Brand::class);
		$brands = $brandRepository->findFilterItems();
		
		$builder
		->add('brand', ChoiceType::class, array(
				'choices' 		=> $brands,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('topProduktImage', ElFinderType::class, array(
				'instance'=>'topProdukt',
				'required' => false
		))
		->add('price', NumberType::class, array(
				'attr' => ['placeholder' => 'label.product.price'],
				'required' => false
		))
		;
		
		$builder->get('brand')->addModelTransformer(new BrandToNumberTransformer($this->em));
		
		
		//TODO move to factory/common/BenchmarkFieldFormBuilder class
		/** @var ProductFilter $filter */
		$filter = $options['filter'];
		
		if($filter) {
			foreach ($filter->getEditorFields() as $field) {
				$valueField = $field['valueField'];
				$fieldName = $field['fieldName'];
				switch($field['fieldType']) {
					case BenchmarkField::DECIMAL_FIELD_TYPE:
						$builder->add($valueField, NumberType::class, array(
								'attr' => ['placeholder' => $fieldName],
								'required' => false
						));
						break;
					case BenchmarkField::INTEGER_FIELD_TYPE:
						$builder->add($valueField, IntegerType::class, array(
								'attr' => ['placeholder' => $fieldName],
								'required' => false
						));
						break;
					case BenchmarkField::BOOLEAN_FIELD_TYPE:
						$builder->add($valueField, CheckboxType::class, array(
								'required' => false
						));
						
						$builder->get($valueField)->addModelTransformer(new IntegerToBooleanTransformer());
						break;
					default:
						$builder->add($valueField, null, array(
							'attr' => ['placeholder' => $fieldName],
							'required' => false
						));
						break;
				}
			}
		}
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options['filter'] = null;
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return Product::class;
	}
}