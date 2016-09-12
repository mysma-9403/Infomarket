<?php

namespace AppBundle\Form\Base;

use AppBundle\Entity\Base\ImageEntity;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ImageEntityType extends SimpleEntityType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMainFields()
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
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return ImageEntity::class;
	}
}