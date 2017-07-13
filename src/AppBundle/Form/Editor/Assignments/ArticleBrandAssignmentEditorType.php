<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\ArticleBrandAssignment;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
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
	
	public function __construct(EntityToNumberTransformer $articleTransformer, EntityToNumberTransformer $brandTransformer) {
		$this->articleTransformer = $articleTransformer;
		$this->brandTransformer = $brandTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addSingleChoiceField($builder, $options, $this->articleTransformer, 'article');
		$this->addSingleChoiceField($builder, $options, $this->brandTransformer, 'brand');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options['article'] = [];
		$options['brand'] = [];
	
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