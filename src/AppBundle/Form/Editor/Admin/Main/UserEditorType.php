<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\User;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
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
		
		$this->addNumberChoiceEditorField($builder, $options, 'roles', true, true, true);
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