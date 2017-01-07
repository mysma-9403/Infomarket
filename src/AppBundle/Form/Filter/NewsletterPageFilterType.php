<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\NewsletterPageFilter;
use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\NewsletterPageTemplateRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterPageFilterType extends SimpleEntityFilterType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('newsletterPageTemplates', EntityType::class, array(
					'class'			=> NewsletterPageTemplate::class,
					'query_builder' => function (NewsletterPageTemplateRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'required'		=> false,
					'expanded'      => false,
					'multiple'      => true,
					'placeholder'	=> 'label.choose.newsletterPageTemplates'
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterPageFilter::class;
	}
}