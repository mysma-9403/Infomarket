<?php

namespace AppBundle\Form;

use AppBundle\Entity\Branch;
use AppBundle\Form\Base\SimpleEntityType;
use Symfony\Component\Form\FormBuilderInterface;

class BranchType extends SimpleEntityType
{
	/**
	 * {@inheritDoc}
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
	 * {@inheritdoc}
	 */
	protected function getEntityClass() {
		return Branch::class;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityName() {
		return 'branch';
	}
}