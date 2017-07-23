<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Factory\Common\Name\NameFactory;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
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
	
	public function __construct(
			NameFactory $choicesNameFactory, 
			EntityToNumberTransformer $newsletterUserTransformer, 
			EntityToNumberTransformer $newsletterGroupTransformer) {
		parent::__construct($choicesNameFactory);
		
		$this->newsletterUserTransformer = $newsletterUserTransformer;
		$this->newsletterGroupTransformer = $newsletterGroupTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->newsletterUserTransformer, 'newsletterUser');
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->newsletterGroupTransformer, 'newsletterGroup');
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