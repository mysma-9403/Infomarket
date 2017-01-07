<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\AdvertCategoryAssignmentFilter;
use AppBundle\Form\Filter\Base\BaseEntityFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\AdvertRepository;
use AppBundle\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class AdvertCategoryAssignmentFilterType extends BaseEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('adverts', EntityType::class, array(
				'class'			=> Advert::class,
				'query_builder' => function (AdvertRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.published DESC, e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.advert'
		))
		->add('categories', EntityType::class, array(
				'class'			=> Category::class,
				'query_builder' => function (CategoryRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.published DESC, e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.category'
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return AdvertCategoryAssignmentFilter::class;
	}
}