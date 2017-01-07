<?php

namespace AppBundle\Form\Filter\Base;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleEntityFilterType extends BaseEntityFilterType
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
		->add('name', TextType::class, array(
				'attr' => array(
						'autofocus' => true,
						'placeholder' => 'label.name'
				),
				'required' => false
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Filter\Base\BaseEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return SimpleEntityFilter::class;
	}
}