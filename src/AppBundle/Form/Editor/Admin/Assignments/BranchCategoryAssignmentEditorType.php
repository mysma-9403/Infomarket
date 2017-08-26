<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\BranchCategoryAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class BranchCategoryAssignmentEditorType extends BaseEntityEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $branchTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $categoryTransformer;

	public function __construct(EntityToNumberTransformer $branchTransformer, EntityToNumberTransformer $categoryTransformer) {
		$this->branchTransformer = $branchTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->branchTransformer, 'branch');
		$this->addTrueEntityChoiceField($builder, $options, $this->categoryTransformer, 'category');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('branch')] = [ ];
		$options[self::getChoicesName('category')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return BranchCategoryAssignment::class;
	}
}