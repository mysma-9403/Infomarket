<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Factory\Common\Name\NameFactory;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleTagAssignmentEditorType extends BaseEntityEditorType
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
	protected $tagTransformer;
	
	public function __construct(
			NameFactory $choicesNameFactory, 
			EntityToNumberTransformer $articleTransformer, 
			EntityToNumberTransformer $tagTransformer) {
		parent::__construct($choicesNameFactory);
				
		$this->articleTransformer = $articleTransformer;
		$this->tagTransformer = $tagTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->articleTransformer, 'article');
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->tagTransformer, 'tag');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('article')] = [];
		$options[self::getChoicesName('tag')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleTagAssignment::class;
	}
}