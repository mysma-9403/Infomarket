<?php

namespace AppBundle\Form\Editor\Base;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class FeaturedEntityEditorType extends ImageEntityEditorType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityEditorType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$builder
			->add('featured', CheckboxType::class, array(
					'required' => false
			))
		;
	}
}