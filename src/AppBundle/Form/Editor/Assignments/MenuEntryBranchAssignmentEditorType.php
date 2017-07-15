<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\MenuEntryBranchAssignment;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryBranchAssignmentEditorType extends BaseEntityEditorType
{
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
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addChoiceEntityField($builder, $options, $this->menuEntryTransformer, 'menuEntry');
		$this->addChoiceEntityField($builder, $options, $this->branchTransformer, 'branch');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('menuEntry')] = [];
		$options[self::getChoicesName('branch')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return MenuEntryBranchAssignment::class;
	}
}