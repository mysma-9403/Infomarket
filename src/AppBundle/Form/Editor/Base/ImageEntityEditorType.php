<?php

namespace AppBundle\Form\Editor\Base;

use AppBundle\Entity\Base\ImageEntity;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class ImageEntityEditorType extends SimpleEntityEditorType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityEditorType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$builder
			->add('file', FileType::class, array(
					'required' => false
			))
			->add('vertical', null, array(
					'required' => false
			))
			->add('forcedWidth', NumberType::class, array(
					'required' => false,
					'attr' => ['placeholder' => 'label.forcedWidth']
			))
			->add('forcedHeight', NumberType::class, array(
					'required' => false,
					'attr' => ['placeholder' => 'label.forcedHeight']
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityEditorType::getEntityType()
	 */
	protected function getEntityType() {
		return ImageEntity::class;
	}
}