<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Assignments\TermCategoryAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class TermCategoryAssignmentEditorType extends BaseEditorType {

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

	public function __construct(EntityToNumberTransformer $termTransformer, 
			EntityToNumberTransformer $categoryTransformer) {
		$this->termTransformer = $termTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->termTransformer, 'term');
		$this->addTrueEntityChoiceField($builder, $options, $this->categoryTransformer, 'category');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('term')] = [ ];
		$options[self::getChoicesName('category')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return TermCategoryAssignment::class;
	}
}