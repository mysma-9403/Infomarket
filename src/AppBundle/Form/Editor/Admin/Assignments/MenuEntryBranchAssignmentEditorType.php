<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\MenuEntryBranchAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryBranchAssignmentEditorType extends BaseEntityEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $menuEntryTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $branchTransformer;

	public function __construct(EntityToNumberTransformer $menuEntryTransformer, EntityToNumberTransformer $branchTransformer) {
		$this->menuEntryTransformer = $menuEntryTransformer;
		$this->branchTransformer = $branchTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->menuEntryTransformer, 'menuEntry');
		$this->addTrueEntityChoiceField($builder, $options, $this->branchTransformer, 'branch');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('menuEntry')] = [ ];
		$options[self::getChoicesName('branch')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return MenuEntryBranchAssignment::class;
	}
}