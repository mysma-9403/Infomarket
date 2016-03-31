<?php

namespace AppBundle\Form\Base;

use AppBundle\Entity\Base\SimpleEntity;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleEntityType extends BaseFormType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('name', TextType::class, array(
					'attr' => array('autofocus' => true)
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addActions()
	 */
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder
			->add('saveAndNew', SubmitType::class)
			->add('saveAndCopy', SubmitType::class)
			->add('saveAndQuit', SubmitType::class);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::getEntityType()
	 */
	protected function getEntityType() {
		return SimpleEntity::class;
	}
}