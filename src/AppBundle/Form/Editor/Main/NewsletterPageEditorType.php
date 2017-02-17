<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\NewsletterPage;
use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\Editor\Transformer\NewsletterPageTemplateToNumberTransformer;

class NewsletterPageEditorType extends SimpleEntityEditorType
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
		
		/** @var NewsletterPageTemplateRepository $newsletterPageTemplateRepository */
		$newsletterPageTemplateRepository = $this->em->getRepository(NewsletterPageTemplate::class);
		$newsletterPageTemplates = $newsletterPageTemplateRepository->findFilterItems();
		
		$builder
		->add('subname', TextType::class, array(
				'required' => false
		))
		->add('newsletterPageTemplate', ChoiceType::class, array(
				'choices' 		=> $newsletterPageTemplates,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		;
		
		$builder->get('newsletterPageTemplate')->addModelTransformer(new NewsletterPageTemplateToNumberTransformer($this->em));
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