<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Assignments\MagazineBranchAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class MagazineBranchAssignmentEditorType extends BaseEditorType {

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

	public function __construct(EntityToNumberTransformer $magazineTransformer, 
			EntityToNumberTransformer $branchTransformer) {
		$this->magazineTransformer = $magazineTransformer;
		$this->branchTransformer = $branchTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->magazineTransformer, 'magazine');
		$this->addTrueEntityChoiceField($builder, $options, $this->branchTransformer, 'branch');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('magazine')] = [ ];
		$options[self::getChoicesName('branch')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return MagazineBranchAssignment::class;
	}
}