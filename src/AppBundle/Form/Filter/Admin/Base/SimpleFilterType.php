<?php

namespace AppBundle\Form\Filter\Admin\Base;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Filter\Admin\Base\SimpleFilter;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleFilterType extends AdminFilterType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Filter\Base\BaseEntityFilterType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$publishChoices = array(
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.published' 	=> SimpleEntityFilter::TRUE_VALUES,
				'label.unpublished' => SimpleEntityFilter::FALSE_VALUES
		);
		
		$builder
		->add('infomarket', ChoiceType::class, array(
				'choices'		=> $publishChoices,
				'expanded'      => false,
				'multiple'      => false,
				'required' 		=> true
		))
		->add('infoprodukt', ChoiceType::class, array(
				'choices'		=> $publishChoices,
				'expanded'      => false,
				'multiple'      => false,
				'required' 		=> true
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Filter\Base\BaseEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return SimpleFilter::class;
	}
}