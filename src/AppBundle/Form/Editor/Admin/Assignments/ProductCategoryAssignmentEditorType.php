<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class ProductCategoryAssignmentEditorType extends BaseEditorType {

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

	public function __construct(EntityToNumberTransformer $productTransformer, 
			EntityToNumberTransformer $segmentTransformer, EntityToNumberTransformer $categoryTransformer) {
		$this->productTransformer = $productTransformer;
		$this->segmentTransformer = $segmentTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addIntegerField($builder, 'orderNumber', 'label.orderNumber');
		
		$this->addCheckboxField($builder, 'featured', 'label.featured');
		
		$this->addTrueEntityChoiceField($builder, $options, $this->productTransformer, 'product');
		$this->addTrueEntityChoiceField($builder, $options, $this->segmentTransformer, 'segment');
		$this->addTrueEntityChoiceField($builder, $options, $this->categoryTransformer, 'category');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('product')] = [ ];
		$options[self::getChoicesName('segment')] = [ ];
		$options[self::getChoicesName('category')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return ProductCategoryAssignment::class;
	}
}