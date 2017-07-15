<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterUserNewsletterGroupAssignmentEditorType extends BaseEntityEditorType
{
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterUserTransformer;
	
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterGroupTransformer;
	
	public function __construct(EntityToNumberTransformer $newsletterUserTransformer, EntityToNumberTransformer $newsletterGroupTransformer) {
		$this->newsletterUserTransformer = $newsletterUserTransformer;
		$this->newsletterGroupTransformer = $newsletterGroupTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addChoiceEntityField($builder, $options, $this->newsletterUserTransformer, 'newsletterUser');
		$this->addChoiceEntityField($builder, $options, $this->newsletterGroupTransformer, 'newsletterGroup');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('newsletterUser')] = [];
		$options[self::getChoicesName('newsletterGroup')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterUserNewsletterGroupAssignment::class;
	}
}