<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\NewsletterBlockArticleAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockArticleAssignmentEditorType extends BaseEntityEditorType
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
	protected $articleTransformer;
	
	public function __construct(
			EntityToNumberTransformer $newsletterBlockTransformer, 
			EntityToNumberTransformer $articleTransformer) {
		
		$this->newsletterBlockTransformer = $newsletterBlockTransformer;
		$this->articleTransformer = $articleTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->newsletterBlockTransformer, 'newsletterBlock');
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->articleTransformer, 'article');
		
		$builder
		->add('alternativeName', TextType::class, array(
				'required' => false
		))
		->add('alternativeSubname', TextType::class, array(
				'required' => false
		))
		->add('alternativeBrands', TextType::class, array(
				'required' => false
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('newsletterBlock')] = [];
		$options[self::getChoicesName('article')] = [];
		
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockArticleAssignment::class;
	}
}