<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\MagazineBranchAssignment;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
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
	
	public function __construct(EntityToNumberTransformer $magazineTransformer, EntityToNumberTransformer $branchTransformer) {
		$this->magazineTransformer = $magazineTransformer;
		$this->branchTransformer = $branchTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addSingleChoiceField($builder, $options, $this->magazineTransformer, 'magazine');
		$this->addSingleChoiceField($builder, $options, $this->branchTransformer, 'branch');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options['magazine'] = [];
		$options['branch'] = [];
	
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