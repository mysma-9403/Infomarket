<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Product;
use AppBundle\Filter\Common\Other\ProductFilter;
use AppBundle\Form\Editor\Base\ImageEntityEditorType;
use AppBundle\Form\FormBuilder\BenchmarkFieldEditorBuilder;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductEditorType extends ImageEntityEditorType
{	
	/**
	 * 
	 * @var EntityToNumberTransformer
	 */
	protected $brandToNumberTransformer;
	
	/**
	 * 
	 * @var BenchmarkFieldEditorBuilder
	 */
	protected $benchmarkFieldEditorBuilder;
	
	public function __construct(EntityToNumberTransformer $brandToNumberTransformer, BenchmarkFieldEditorBuilder $benchmarkFieldEditorBuilder) {
		$this->brandToNumberTransformer = $brandToNumberTransformer;
		$this->benchmarkFieldEditorBuilder = $benchmarkFieldEditorBuilder;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('topProduktImage', ElFinderType::class, array(
				'instance'=>'topProdukt',
				'required' => false
		))
		->add('price', NumberType::class, array(
				'attr' => ['placeholder' => 'label.product.price'],
				'required' => false
		))
		;
		
		$this->addSingleChoiceField($builder, $options, $this->brandToNumberTransformer, 'brand');
		
		$this->addFilterFields($builder, $options);
	}
	
	protected function addFilterFields(FormBuilderInterface $builder, array $options) {
		/** @var ProductFilter $filter */
		$filter = $options['filter'];
		
		if($filter) {
			foreach ($filter->getEditorFields() as $field) {
				$this->benchmarkFieldEditorBuilder->add($builder, $field);
			}
		}
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options['brand'] = [];
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