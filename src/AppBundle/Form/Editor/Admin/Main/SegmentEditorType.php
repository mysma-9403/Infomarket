<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Segment;
use AppBundle\Form\Editor\Admin\Base\ImageEntityEditorType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SegmentEditorType extends ImageEntityEditorType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('subname', TextType::class, array(
				'required' => true
		))
		->add('color', TextType::class, array(
					'required' => true
		))
		->add('orderNumber', IntegerType::class, array(
					'required' => true
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return Segment::class;
	}
}