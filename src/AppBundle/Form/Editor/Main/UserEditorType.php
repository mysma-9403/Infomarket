<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\User;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
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
		;
		
		$this->addChoiceNumberEditorField($builder, $options, 'roles', true, true);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('roles')] = [];
	
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