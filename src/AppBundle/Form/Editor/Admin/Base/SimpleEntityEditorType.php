<?php

namespace AppBundle\Form\Editor\Admin\Base;

use AppBundle\Entity\Base\SimpleEntity;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleEntityEditorType extends BaseEntityEditorType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$builder
			->add('name', TextType::class, array(
					'attr' => array('autofocus' => true),
					'required' => false
			))
			->add('infomarket', CheckboxType::class, array(
					'required' => false
			))
			->add('infoprodukt', CheckboxType::class, array(
					'required' => false
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType::getEntityType()
	 */
	protected function getEntityType() {
		return SimpleEntity::class;
	}
}