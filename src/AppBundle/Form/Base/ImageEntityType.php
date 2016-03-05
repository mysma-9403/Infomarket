<?php

namespace AppBundle\Form\Base;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use AppBundle\Entity\Base\ImageEntity;

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
			->add('image', FileType::class, array(
					'required' => false
			));
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