<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\ArticleCategoryAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleCategoryAssignmentEditorType extends BaseEntityEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $articleTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $categoryTransformer;

	public function __construct(EntityToNumberTransformer $articleTransformer, EntityToNumberTransformer $categoryTransformer) {
		$this->articleTransformer = $articleTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->articleTransformer, 'article');
		$this->addTrueEntityChoiceField($builder, $options, $this->categoryTransformer, 'category');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('article')] = [ ];
		$options[self::getChoicesName('category')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return ArticleCategoryAssignment::class;
	}
}