<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\MagazineFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Magazine;
use AppBundle\Repository\MagazineRepository;

class MagazineFilterType extends SimpleEntityFilterType
{	
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		parent::addMoreFields($builder, $options);
		
		$featuredChoices = array(
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.featured' 	=> SimpleEntityFilter::TRUE_VALUES,
				'label.notFeatured' => SimpleEntityFilter::FALSE_VALUES
		);
		
		$mainChoices = array(
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.main' 		=> SimpleEntityFilter::TRUE_VALUES,
				'label.notMain' 	=> SimpleEntityFilter::FALSE_VALUES
		);
		
		$builder
			->add('parents', EntityType::class, array(
				'class'			=> Magazine::class,
				'query_builder' => function (MagazineRepository $repository) {
				return $repository->createQueryBuilder('e')
				->where('e.main = true')
				->orderBy('e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.magazines'
			))
			->add('featured', ChoiceType::class, array(
					'choices'		=> $featuredChoices,
					'expanded'      => false,
					'multiple'      => false
			))
			->add('main', ChoiceType::class, array(
					'choices'		=> $mainChoices,
					'expanded'      => false,
					'multiple'      => false
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return MagazineFilter::class;
	}
}