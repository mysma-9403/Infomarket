<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\LinkFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LinkFilterType extends SimpleEntityFilterType
{
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		parent::addMoreFields($builder, $options);
		
		$builder
		->add('url', TextType::class, array(
				'attr' => array(
						'placeholder' => 'label.url'
				),
				'required' => false
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return LinkFilter::class;
	}
}