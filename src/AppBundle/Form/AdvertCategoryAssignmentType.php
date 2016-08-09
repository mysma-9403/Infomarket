<?php

namespace AppBundle\Form;

use AppBundle\Entity\Advert;
use AppBundle\Entity\AdvertCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Base\BaseFormType;
use AppBundle\Form\Base\ImageEntityType;
use AppBundle\Repository\AdvertRepository;
use AppBundle\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class AdvertCategoryAssignmentType extends BaseFormType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('advert', EntityType::class, array(
					'class'			=> Advert::class,
					'query_builder' => function (AdvertRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'choice_label' 	=> 'displayName',
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.advert'
			))
			->add('category', EntityType::class, array(
					'class'			=> Category::class,
					'query_builder' => function (CategoryRepository $repository) {
						return $repository->createQueryBuilder('e')
						->where('e.preleaf = true')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'choice_label' 	=> 'displayName',
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.category'
			))
		;
	}
	
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return AdvertCategoryAssignment::class;
	}
}