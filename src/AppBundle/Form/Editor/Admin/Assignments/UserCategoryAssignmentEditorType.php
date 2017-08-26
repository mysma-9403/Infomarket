<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\UserCategoryAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class UserCategoryAssignmentEditorType extends BaseEntityEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $userTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $categoryTransformer;

	public function __construct(EntityToNumberTransformer $userTransformer, EntityToNumberTransformer $categoryTransformer) {
		$this->userTransformer = $userTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->userTransformer, 'user');
		$this->addTrueEntityChoiceField($builder, $options, $this->categoryTransformer, 'category');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('user')] = [ ];
		$options[self::getChoicesName('category')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return UserCategoryAssignment::class;
	}
}