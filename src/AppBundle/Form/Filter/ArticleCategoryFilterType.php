<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\ArticleCategoryFilter;
use AppBundle\Form\Filter\Base\ImageEntityFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticleCategoryFilterType extends ImageEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$featuredChoices = array(
				'All'			=> SimpleEntityFilter::ALL_VALUES,
				'Featured' 		=> SimpleEntityFilter::TRUE_VALUES,
				'Not featured' 	=> SimpleEntityFilter::FALSE_VALUES
		);
	
		$builder
		->add('featured', ChoiceType::class, array(
				'choices'		=> $featuredChoices,
				'expanded'      => false,
				'multiple'      => false,
				'required' 		=> true
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleCategoryFilter::class;
	}
}