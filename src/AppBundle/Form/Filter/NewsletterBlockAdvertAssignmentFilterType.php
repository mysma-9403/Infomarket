<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\Filter\NewsletterBlockAdvertAssignmentFilter;
use AppBundle\Entity\Advert;
use AppBundle\Form\Filter\Base\BaseEntityFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\NewsletterBlockRepository;
use AppBundle\Repository\AdvertRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockAdvertAssignmentFilterType extends BaseEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('newsletterBlocks', EntityType::class, array(
				'class'			=> NewsletterBlock::class,
				'query_builder' => function (NewsletterBlockRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.newsletterBlock'
		))
		->add('adverts', EntityType::class, array(
				'class'			=> Advert::class,
				'query_builder' => function (AdvertRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.advert'
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockAdvertAssignmentFilter::class;
	}
}