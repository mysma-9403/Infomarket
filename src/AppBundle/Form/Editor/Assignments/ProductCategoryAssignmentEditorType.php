<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductCategoryAssignmentEditorType extends BaseEntityEditorType
{	
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $productTransformer;
	
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $categoryTransformer;
	
	public function __construct(
			EntityToNumberTransformer $productTransformer,
			EntityToNumberTransformer $segmentTransformer,
			EntityToNumberTransformer $categoryTransformer) {
		
		$this->productTransformer = $productTransformer;
		$this->segmentTransformer = $segmentTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addChoiceEntityEditorField($builder, $options, $this->productTransformer, 'product');
		$this->addChoiceEntityEditorField($builder, $options, $this->segmentTransformer, 'segment');
		$this->addChoiceEntityEditorField($builder, $options, $this->categoryTransformer, 'category');
		
		$builder
		->add('orderNumber', IntegerType::class, array(
				'required'		=> true
		))
		->add('featured', CheckboxType::class, array(
				'required'		=> false
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('product')] = [];
		$options[self::getChoicesName('segment')] = [];
		$options[self::getChoicesName('category')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return ProductCategoryAssignment::class;
	}
}