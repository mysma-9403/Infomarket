<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\ArticleArticleCategoryAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleArticleCategoryAssignmentEditorType extends BaseEntityEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $articleTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $articleCategoryTransformer;

	public function __construct(EntityToNumberTransformer $articleTransformer, EntityToNumberTransformer $articleCategoryTransformer) {
		$this->articleTransformer = $articleTransformer;
		$this->articleCategoryTransformer = $articleCategoryTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->articleTransformer, 'article');
		$this->addTrueEntityChoiceField($builder, $options, $this->articleCategoryTransformer, 'articleCategory');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('article')] = [ ];
		$options[self::getChoicesName('articleCategory')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return ArticleArticleCategoryAssignment::class;
	}
}