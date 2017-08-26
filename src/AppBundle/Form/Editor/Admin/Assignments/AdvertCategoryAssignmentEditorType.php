<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\AdvertCategoryAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class AdvertCategoryAssignmentEditorType extends BaseEntityEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $advertTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $categoryTransformer;

	public function __construct(EntityToNumberTransformer $advertTransformer, EntityToNumberTransformer $categoryTransformer) {
		$this->advertTransformer = $advertTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->advertTransformer, 'advert');
		$this->addTrueEntityChoiceField($builder, $options, $this->categoryTransformer, 'category');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('advert')] = [ ];
		$options[self::getChoicesName('category')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return AdvertCategoryAssignment::class;
	}
}