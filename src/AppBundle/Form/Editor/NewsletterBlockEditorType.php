<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;
use AppBundle\Repository\NewsletterBlockTemplateRepository;
use AppBundle\Repository\NewsletterPageRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockEditorType extends SimpleEntityEditorType
{
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
			->add('newsletterPage', EntityType::class, array(
					'class'			=> NewsletterPage::class,
					'query_builder' => function (NewsletterPageRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.name', 'ASC');
					},
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.newsletterPage'
			))
			->add('newsletterBlockTemplate', EntityType::class, array(
					'class'			=> NewsletterBlockTemplate::class,
					'query_builder' => function (NewsletterBlockTemplateRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.name', 'ASC');
					},
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.newsletterBlockTemplate'
			))
		;
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