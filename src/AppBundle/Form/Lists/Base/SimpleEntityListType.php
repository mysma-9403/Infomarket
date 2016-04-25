<?php

namespace AppBundle\Form\Lists\Base;

use AppBundle\Entity\Base\SimpleEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleEntityListType extends BaseEntityListType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('entries', EntityType::class, array(
					'class'			=> $this->getChoiceType(),
					'choice_label' 	=> 'name',
					'choices'		=> $options['choices'],
					'expanded'      => true,
					'multiple'      => true
			));
	}
	
	/**
	 * Get listed entitys' type.
	 *
	 * @return mixed (e.g <strong>Product::class</strong>)
	 */
	protected function getChoiceType() {
		return SimpleEntity::class;
	}
}