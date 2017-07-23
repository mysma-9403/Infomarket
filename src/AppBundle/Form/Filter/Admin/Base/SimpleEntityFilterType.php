<?php

namespace AppBundle\Form\Filter\Admin\Base;

use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleEntityFilterType extends SimpleFilterType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Filter\Base\BaseEntityFilterType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$builder
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