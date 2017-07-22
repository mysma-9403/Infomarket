<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\MagazineBranchAssignment;
use AppBundle\Factory\Common\Name\NameFactory;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class MagazineBranchAssignmentEditorType extends BaseEntityEditorType
{
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $magazineTransformer;
	
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $branchTransformer;
	
	public function __construct(
			NameFactory $choicesNameFactory, 
			EntityToNumberTransformer $magazineTransformer, 
			EntityToNumberTransformer $branchTransformer) {
		parent::__construct($choicesNameFactory);
		
		$this->magazineTransformer = $magazineTransformer;
		$this->branchTransformer = $branchTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->magazineTransformer, 'magazine');
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->branchTransformer, 'branch');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('magazine')] = [];
		$options[self::getChoicesName('branch')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return MagazineBranchAssignment::class;
	}
}