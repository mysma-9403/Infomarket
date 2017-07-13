<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\NewsletterBlockMagazineAssignment;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockMagazineAssignmentEditorType extends BaseEntityEditorType
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
	protected $magazineTransformer;
	
	public function __construct(EntityToNumberTransformer $newsletterBlockTransformer, EntityToNumberTransformer $magazineTransformer) {
		$this->newsletterBlockTransformer = $newsletterBlockTransformer;
		$this->magazineTransformer = $magazineTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addSingleChoiceField($builder, $options, $this->newsletterBlockTransformer, 'newsletterBlock');
		$this->addSingleChoiceField($builder, $options, $this->magazineTransformer, 'magazine');
		
		$builder
		->add('alternativeName', TextType::class, array(
				'required' => false
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options['newsletterBlock'] = [];
		$options['magazine'] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockMagazineAssignment::class;
	}
}