<?php

namespace AppBundle\Form\Search\Base;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleEntitySearchType extends \AppBundle\Form\Base\SearchType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$builder
		->add('name', SearchType::class, array(
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
	 * @see \AppBundle\Form\Base\BaseType::getEntityType()
	 */
	protected function getEntityType() {
		return SimpleEntityFilter::class;
	}
}