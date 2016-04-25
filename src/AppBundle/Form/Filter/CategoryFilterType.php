<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Form\Filter\Base\ImageEntityFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;

class CategoryFilterType extends ImageEntityFilterType
{	
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		//TODO pole klasy bazowej do resue?
		$publishChoices = array(
				'All'			=> SimpleEntityFilter::ALL_VALUES,
				'Published' 	=> SimpleEntityFilter::TRUE_VALUES,
				'Unpublished' 	=> SimpleEntityFilter::FALSE_VALUES
		);
		
		$builder
			->add('published', ChoiceType::class, array(
					'placeholder'	=> 'All',
					'choices'		=> $publishChoices,
					'expanded'      => false,
					'multiple'      => false,
					'required' 		=> false
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