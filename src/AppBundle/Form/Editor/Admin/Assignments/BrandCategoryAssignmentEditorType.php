<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class BrandCategoryAssignmentEditorType extends BaseEntityEditorType {

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

	public function __construct(EntityToNumberTransformer $brandTransformer, EntityToNumberTransformer $categoryTransformer) {
		$this->brandTransformer = $brandTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addIntegerField($builder, 'orderNumber', 'label.orderNumber');
		
		$this->addTrueEntityChoiceField($builder, $options, $this->brandTransformer, 'brand');
		$this->addTrueEntityChoiceField($builder, $options, $this->categoryTransformer, 'category');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('brand')] = [ ];
		$options[self::getChoicesName('category')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return BrandCategoryAssignment::class;
	}
}