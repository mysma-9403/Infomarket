<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Article;
use AppBundle\Entity\Filter\NewsletterBlockFilter;
use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\AdvertRepository;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Repository\NewsletterBlockTemplateRepository;
use AppBundle\Repository\NewsletterPageRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockFilterType extends SimpleEntityFilterType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('newsletterPages', EntityType::class, array(
					'class'			=> NewsletterPage::class,
					'query_builder' => function (NewsletterPageRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'required'		=> false,
					'expanded'      => false,
					'multiple'      => true,
					'placeholder'	=> 'label.choose.newsletterPages'
			))
			->add('newsletterBlockTemplates', EntityType::class, array(
					'class'			=> NewsletterBlockTemplate::class,
					'query_builder' => function (NewsletterBlockTemplateRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'required'		=> false,
					'expanded'      => false,
					'multiple'      => true,
					'placeholder'	=> 'label.choose.newsletterBlockTemplates'
			))
			->add('adverts', EntityType::class, array(
					'class'			=> Advert::class,
					'query_builder' => function (AdvertRepository $repository) {
					return $repository->createQueryBuilder('e')
					->where('e.published = true')
					->orderBy('e.name', 'ASC');
					},
					'required'		=> false,
					'expanded'      => false,
					'multiple'      => true,
					'placeholder'	=> 'label.choose.adverts'
			))
			->add('articles', EntityType::class, array(
					'class'			=> Article::class,
					'query_builder' => function (ArticleRepository $repository) {
					return $repository->createQueryBuilder('e')
					->where('e.published = true AND e.parent IS NULL')
					->orderBy('e.name', 'ASC');
					},
					'required'		=> false,
					'expanded'      => false,
					'multiple'      => true,
					'placeholder'	=> 'label.choose.articles'
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockFilter::class;
	}
}