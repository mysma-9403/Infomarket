<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Form\Filter\Base\ImageEntityFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryFilterType extends ImageEntityFilterType
{	
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$featuredChoices = array(
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.featured' 	=> SimpleEntityFilter::TRUE_VALUES,
				'label.notFeatured' => SimpleEntityFilter::FALSE_VALUES
		);
		
		$preleafChoices = array(
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.preleafs' 	=> SimpleEntityFilter::TRUE_VALUES,
				'label.others'  	=> SimpleEntityFilter::FALSE_VALUES
		);
		
		$rootChoices = array(
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.roots' 		=> SimpleEntityFilter::TRUE_VALUES,
				'label.children' 	=> SimpleEntityFilter::FALSE_VALUES
		);
		
		$builder
			->add('subname', TextType::class, array(
					'attr' => array(
							'placeholder' => 'label.subname'
					),
					'required' => false
			))
			->add('featured', ChoiceType::class, array(
					'choices'		=> $featuredChoices,
					'expanded'      => false,
					'multiple'      => false
			))
			->add('preleaf', ChoiceType::class, array(
					'choices'		=> $preleafChoices,
					'expanded'      => false,
					'multiple'      => false
			))
			->add('root', ChoiceType::class, array(
					'choices'		=> $rootChoices,
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
		return CategoryFilter::class;
	}
}