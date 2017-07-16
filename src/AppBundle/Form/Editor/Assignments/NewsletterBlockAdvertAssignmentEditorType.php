<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\NewsletterBlockAdvertAssignment;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockAdvertAssignmentEditorType extends BaseEntityEditorType
{
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterBlockTransformer;
	
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $advertTransformer;
	
	public function __construct(EntityToNumberTransformer $newsletterBlockTransformer, EntityToNumberTransformer $advertTransformer) {
		$this->newsletterBlockTransformer = $newsletterBlockTransformer;
		$this->advertTransformer = $advertTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addChoiceEntityEditorField($builder, $options, $this->newsletterBlockTransformer, 'newsletterBlock');
		$this->addChoiceEntityEditorField($builder, $options, $this->advertTransformer, 'advert');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('newsletterBlock')] = [];
		$options[self::getChoicesName('advert')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockAdvertAssignment::class;
	}
}