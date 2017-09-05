<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Assignments\MenuEntryCategoryAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryCategoryAssignmentEditorType extends BaseEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $menuEntryTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $categoryTransformer;

	public function __construct(EntityToNumberTransformer $menuEntryTransformer, 
			EntityToNumberTransformer $categoryTransformer) {
		$this->menuEntryTransformer = $menuEntryTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->menuEntryTransformer, 'menuEntry');
		$this->addTrueEntityChoiceField($builder, $options, $this->categoryTransformer, 'category');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('menuEntry')] = [ ];
		$options[self::getChoicesName('category')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return MenuEntryCategoryAssignment::class;
	}
}