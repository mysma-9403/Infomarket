<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\UserFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserFilterType extends SimpleEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Filter\Base\SimpleEntityFilterType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
	
		$builder
			->add('username', TextType::class, array(
					'attr' => array(
							'autofocus' => true,
							'placeholder' => 'label.user.username'
					),
					'required' => false
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
			->add('forename', TextType::class, array(
					'attr' => array(
							'autofocus' => true,
							'placeholder' => 'label.user.forename'
					),
					'required' => false
			))
			->add('surname', TextType::class, array(
					'attr' => array(
							'autofocus' => true,
							'placeholder' => 'label.user.surname'
					),
					'required' => false
			))
			->add('email', TextType::class, array(
					'attr' => array(
							'autofocus' => true,
							'placeholder' => 'label.user.email'
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
		return UserFilter::class;
	}
}