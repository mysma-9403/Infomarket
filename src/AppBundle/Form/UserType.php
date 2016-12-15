<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use AppBundle\Form\Base\SimpleEntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends SimpleEntityType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('username', TextType::class, array(
				'attr' => array('autofocus' => true),
				'required' => true
		))
		;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$roles = array(
			'Guest' => User::ROLE_DEFAULT,
			'Editor' => User::ROLE_EDITOR,
			'Publisher' => User::ROLE_PUBLISHER,
			'Rating editor' => User::ROLE_RATING_EDITOR,
			'Admin' => User::ROLE_ADMIN,
			'Super admin' => User::ROLE_SUPER_ADMIN
		);
		
		$builder
		->add('forename', TextType::class, array(
				'attr' => array('autofocus' => true),
				'required' => false
		))
		->add('surname', TextType::class, array(
				'attr' => array('autofocus' => true),
				'required' => false
		))
		->add('pseudonym', TextType::class, array(
				'attr' => array('autofocus' => true),
				'required' => false
		))
		->add('email', TextType::class, array(
				'attr' => array('autofocus' => true),
				'required' => false
		))
		->add('roles', ChoiceType::class, array(
				'choices'		=> $roles,
				'placeholder'	=> 'Select roles',
				'multiple'		=> true,
				'expanded'		=> true
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return User::class;
	}
}