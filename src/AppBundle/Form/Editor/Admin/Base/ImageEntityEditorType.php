<?php

namespace AppBundle\Form\Editor\Admin\Base;

use AppBundle\Entity\Base\ImageEntity;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
			->add('vertical', CheckboxType::class, array(
					'required' => false
			))
			->add('forcedWidth', IntegerType::class, array(
					'required' => false,
					'attr' => ['placeholder' => 'label.image.forcedWidth']
			))
			->add('forcedHeight', IntegerType::class, array(
					'required' => false,
					'attr' => ['placeholder' => 'label.image.forcedHeight']
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