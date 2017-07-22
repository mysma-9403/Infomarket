<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\TermCategoryAssignment;
use AppBundle\Factory\Common\Name\NameFactory;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class TermCategoryAssignmentEditorType extends BaseEntityEditorType
{
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $termTransformer;
	
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $categoryTransformer;
	
	public function __construct(
			NameFactory $choicesNameFactory, 
			EntityToNumberTransformer $termTransformer, 
			EntityToNumberTransformer $categoryTransformer) {
		parent::__construct($choicesNameFactory);
		
		$this->termTransformer = $termTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->termTransformer, 'term');
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->categoryTransformer, 'category');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('term')] = [];
		$options[self::getChoicesName('category')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return TermCategoryAssignment::class;
	}
}