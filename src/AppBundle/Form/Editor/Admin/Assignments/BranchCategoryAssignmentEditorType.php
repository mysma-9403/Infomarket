<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\BranchCategoryAssignment;
use AppBundle\Factory\Common\Name\NameFactory;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class BranchCategoryAssignmentEditorType extends BaseEntityEditorType
{
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
	
	public function __construct(
			NameFactory $choicesNameFactory, 
			EntityToNumberTransformer $branchTransformer, 
			EntityToNumberTransformer $categoryTransformer) {
		parent::__construct($choicesNameFactory);
		
		$this->branchTransformer = $branchTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->branchTransformer, 'branch');
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->categoryTransformer, 'category');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('branch')] = [];
		$options[self::getChoicesName('category')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return BranchCategoryAssignment::class;
	}
}