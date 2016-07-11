<?php

namespace AppBundle\Form;

use AppBundle\Entity\Brand;
use AppBundle\Form\Base\ImageEntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class BrandType extends ImageEntityType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
			->add('content', CKEditorType::class, array(
					'config' => array(
							'uiColor' => '#ffffff'),
					'required' => false
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return Brand::class;
	}
}