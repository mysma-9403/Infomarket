<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\ArticleArticleCategoryAssignment;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleArticleCategoryAssignmentEditorType extends BaseEntityEditorType
{
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
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addChoiceEntityField($builder, $options, $this->articleTransformer, 'article');
		$this->addChoiceEntityField($builder, $options, $this->articleCategoryTransformer, 'articleCategory');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('article')] = [];
		$options[self::getChoicesName('articleCategory')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleArticleCategoryAssignment::class;
	}
}