<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\MenuEntryBranchAssignment;
use AppBundle\Factory\Common\Name\NameFactory;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
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
	
	public function __construct(
			NameFactory $choicesNameFactory, 
			EntityToNumberTransformer $menuEntryTransformer, 
			EntityToNumberTransformer $branchTransformer) {
		parent::__construct($choicesNameFactory);
		
		$this->menuEntryTransformer = $menuEntryTransformer;
		$this->branchTransformer = $branchTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->menuEntryTransformer, 'menuEntry');
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->branchTransformer, 'branch');
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