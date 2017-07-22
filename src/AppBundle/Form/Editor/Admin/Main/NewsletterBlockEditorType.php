<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Form\Editor\Admin\Base\SimpleEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockEditorType extends SimpleEntityEditorType
{
	/**
	 * 
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterBlockTemplateTransformer;
	
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterPageTransformer;
	
	
	
	public function __construct(EntityToNumberTransformer $newsletterBlockTemplateTransformer, EntityToNumberTransformer $newsletterPageTransformer) {
		$this->newsletterBlockTemplateTransformer = $newsletterBlockTemplateTransformer;
		$this->newsletterPageTransformer = $newsletterPageTransformer;
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
		->add('orderNumber', IntegerType::class, array(
				'required' => true
		))
		->add('xAdvertRatio', IntegerType::class, array(
				'required' => true
		))
		->add('yAdvertRatio', IntegerType::class, array(
				'required' => true
		))
		->add('xArticleRatio', IntegerType::class, array(
				'required' => true
		))
		->add('yArticleRatio', IntegerType::class, array(
				'required' => true
		))
		->add('xMagazineRatio', IntegerType::class, array(
				'required' => true
		))
		->add('yMagazineRatio', IntegerType::class, array(
				'required' => true
		))
		->add('magazinePadding', IntegerType::class, array(
				'required' => true
		))
		->add('articleSeparator', TextType::class, array(
				'required' => false,
				'trim' => false
		))
		->add('magazineSeparator', TextType::class, array(
				'required' => false,
				'trim' => false
		))
		;
		
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->newsletterBlockTemplateTransformer, 'newsletterBlockTemplate');
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->newsletterPageTransformer, 'newsletterPage');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('newsletterBlockTemplate')] = [];
		$options[self::getChoicesName('newsletterPage')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlock::class;
	}
}