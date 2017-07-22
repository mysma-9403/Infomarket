<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\ArticleBrandAssignment;
use AppBundle\Factory\Common\Name\NameFactory;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleBrandAssignmentEditorType extends BaseEntityEditorType
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
	protected $brandTransformer;
	
	public function __construct(
			NameFactory $choicesNameFactory, 
			EntityToNumberTransformer $articleTransformer, 
			EntityToNumberTransformer $brandTransformer) {
		parent::__construct($choicesNameFactory);
		
		$this->articleTransformer = $articleTransformer;
		$this->brandTransformer = $brandTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->articleTransformer, 'article');
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->brandTransformer, 'brand');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('article')] = [];
		$options[self::getChoicesName('brand')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleBrandAssignment::class;
	}
}