<?php

namespace AppBundle\Form;

use AppBundle\Entity\Segment;
use AppBundle\Form\Base\ImageEntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class SegmentType extends ImageEntityType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('color', TextType::class, array(
					'required' => true
			))
		->add('orderNumber', NumberType::class, array(
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