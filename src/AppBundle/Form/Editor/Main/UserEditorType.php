<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\User;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserEditorType extends BaseEntityEditorType
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
	
		$roles = $options['roles'];
		
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
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options['roles'] = [];
	
		return $options;
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