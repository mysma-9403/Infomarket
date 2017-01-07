<?php

namespace AppBundle\Form\Editor\Base;

use AppBundle\Entity\Base\Audit;
use AppBundle\Form\Base\EditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class BaseEntityEditorType extends EditorType
{
	//TODO remove in second step integration
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
	
		$builder
		->add('published', CheckboxType::class, array(
				'required' => false
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseType::getEntityType()
	 */
	protected function getEntityType() {
		return Audit::class;
	}
}