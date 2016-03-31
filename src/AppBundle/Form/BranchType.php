<?php

namespace AppBundle\Form;

use AppBundle\Entity\Branch;
use AppBundle\Form\Base\ImageEntityType;
use Symfony\Component\Form\FormBuilderInterface;

class BranchType extends ImageEntityType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
			->add('icon', null, array(
					'required' => false
			))
			->add('color', null, array(
					'required' => false
			))
			->add('content', null, array(
					'attr' => array('rows' => 20),
					'required' => false
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return Branch::class;
	}
}