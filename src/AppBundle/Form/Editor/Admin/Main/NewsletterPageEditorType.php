<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\NewsletterPage;
use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Form\Editor\Admin\Base\SimpleEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterPageEditorType extends SimpleEntityEditorType
{
	/**
	 * 
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterPageTemplateToNumberTransformer;
	
	public function __construct(EntityToNumberTransformer $newsletterPageTemplateToNumberTransformer) {
		$this->newsletterPageTemplateToNumberTransformer = $newsletterPageTemplateToNumberTransformer;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		parent::addMoreFields($builder, $options);
		
		$builder
		->add('subname', TextType::class, array(
				'required' => false
		))
		;
		
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->newsletterPageTemplateToNumberTransformer, 'newsletterPageTemplate');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('newsletterPageTemplate')] = [];
		
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterPage::class;
	}
}