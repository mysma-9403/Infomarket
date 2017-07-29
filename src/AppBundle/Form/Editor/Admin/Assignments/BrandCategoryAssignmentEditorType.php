<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class BrandCategoryAssignmentEditorType extends BaseEntityEditorType
{
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $brandTransformer;
	
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $categoryTransformer;
	
	public function __construct(
			EntityToNumberTransformer $brandTransformer, 
			EntityToNumberTransformer $categoryTransformer) {
		
		$this->brandTransformer = $brandTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('orderNumber', IntegerType::class, array(
				'required'		=> true
		))
		;
		
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->brandTransformer, 'brand');
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->categoryTransformer, 'category');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('brand')] = [];
		$options[self::getChoicesName('category')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return BrandCategoryAssignment::class;
	}
}