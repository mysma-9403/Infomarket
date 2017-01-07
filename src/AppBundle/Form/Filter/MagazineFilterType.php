<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\MagazineFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class MagazineFilterType extends SimpleEntityFilterType
{	
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$featuredChoices = array(
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.featured' 	=> SimpleEntityFilter::TRUE_VALUES,
				'label.notFeatured' => SimpleEntityFilter::FALSE_VALUES
		);
		
		$infomarketChoices = array(
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.infomarket' 	=> SimpleEntityFilter::TRUE_VALUES,
				'label.notInfomarket' => SimpleEntityFilter::FALSE_VALUES
		);
		
		$infoproduktChoices = array(
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.infoprodukt' 	=> SimpleEntityFilter::TRUE_VALUES,
				'label.notInfoprodukt' => SimpleEntityFilter::FALSE_VALUES
		);
		
		$featuredChoices = array(
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.featured' 	=> SimpleEntityFilter::TRUE_VALUES,
				'label.notFeatured' => SimpleEntityFilter::FALSE_VALUES
		);
		
		$builder
			->add('featured', ChoiceType::class, array(
					'choices'		=> $featuredChoices,
					'expanded'      => false,
					'multiple'      => false
			))
			->add('infomarket', ChoiceType::class, array(
					'choices'		=> $infomarketChoices,
					'expanded'      => false,
					'multiple'      => false
			))
			->add('infoprodukt', ChoiceType::class, array(
					'choices'		=> $infoproduktChoices,
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