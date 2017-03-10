<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;
use AppBundle\Form\Editor\Transformer\NewsletterBlockTemplateToNumberTransformer;
use AppBundle\Form\Editor\Transformer\NewsletterPageToNumberTransformer;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockEditorType extends SimpleEntityEditorType
{
	protected $em;
	
	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		parent::addMoreFields($builder, $options);
		
		/** @var NewsletterPageRepository $newsletterPageRepository */
		$newsletterPageRepository = $this->em->getRepository(NewsletterPage::class);
		$newsletterPages = $newsletterPageRepository->findFilterItems();
		
		/** @var NewsletterBlockTemplateRepository $newsletterBlockTemplateRepository */
		$newsletterBlockTemplateRepository = $this->em->getRepository(NewsletterBlockTemplate::class);
		$newsletterBlockTemplates = $newsletterBlockTemplateRepository->findFilterItems();
		
		$builder
		->add('subname', TextType::class, array(
				'required' => false
		))
		->add('orderNumber', NumberType::class, array(
				'required' => true
		))
		->add('xAdvertRatio', NumberType::class, array(
				'required' => true
		))
		->add('yAdvertRatio', NumberType::class, array(
				'required' => true
		))
		->add('xArticleRatio', NumberType::class, array(
				'required' => true
		))
		->add('yArticleRatio', NumberType::class, array(
				'required' => true
		))
		->add('xMagazineRatio', NumberType::class, array(
				'required' => true
		))
		->add('yMagazineRatio', NumberType::class, array(
				'required' => true
		))
		->add('magazinePadding', NumberType::class, array(
				'required' => true
		))
		->add('articleSeparator', TextType::class, array(
				'required' => false
		))
		->add('magazineSeparator', TextType::class, array(
				'required' => false
		))
		->add('newsletterPage', ChoiceType::class, array(
				'choices' 		=> $newsletterPages,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('newsletterBlockTemplate', ChoiceType::class, array(
				'choices' 		=> $newsletterBlockTemplates,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		;
		
		$builder->get('newsletterPage')->addModelTransformer(new NewsletterPageToNumberTransformer($this->em));
		$builder->get('newsletterBlockTemplate')->addModelTransformer(new NewsletterBlockTemplateToNumberTransformer($this->em));
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