<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\Filter\NewsletterBlockMagazineAssignmentFilter;
use AppBundle\Entity\Magazine;
use AppBundle\Form\Filter\Base\BaseEntityFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\NewsletterBlockRepository;
use AppBundle\Repository\MagazineRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockMagazineAssignmentFilterType extends BaseEntityFilterType
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
		->add('magazines', EntityType::class, array(
				'class'			=> Magazine::class,
				'query_builder' => function (MagazineRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.magazine'
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockMagazineAssignmentFilter::class;
	}
}