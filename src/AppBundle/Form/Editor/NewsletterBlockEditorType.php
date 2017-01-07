<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Article;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;
use AppBundle\Repository\AdvertRepository;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Repository\NewsletterBlockTemplateRepository;
use AppBundle\Repository\NewsletterPageRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockEditorType extends SimpleEntityEditorType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
			->add('orderNumber', NumberType::class, array(
					'required' => true
			))
			->add('newsletterPage', EntityType::class, array(
					'class'			=> NewsletterPage::class,
					'query_builder' => function (NewsletterPageRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.name', 'ASC');
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
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.newsletterBlockTemplate'
			))
			->add('advert', EntityType::class, array(
					'class'			=> Advert::class,
					'query_builder' => function (AdvertRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.published DESC, e.name', 'ASC');
					},
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.advert'
			))
			->add('article', EntityType::class, array(
					'class'			=> Article::class,
					'query_builder' => function (ArticleRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.published DESC, e.name ASC, e.subname', 'ASC');
					},
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.article'
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