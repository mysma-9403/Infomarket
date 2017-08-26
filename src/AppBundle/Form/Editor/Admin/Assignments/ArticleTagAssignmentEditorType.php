<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleTagAssignmentEditorType extends BaseEntityEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $articleTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $tagTransformer;

	public function __construct(EntityToNumberTransformer $articleTransformer, EntityToNumberTransformer $tagTransformer) {
		$this->articleTransformer = $articleTransformer;
		$this->tagTransformer = $tagTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->articleTransformer, 'article');
		$this->addTrueEntityChoiceField($builder, $options, $this->tagTransformer, 'tag');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('article')] = [ ];
		$options[self::getChoicesName('tag')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return ArticleTagAssignment::class;
	}
}