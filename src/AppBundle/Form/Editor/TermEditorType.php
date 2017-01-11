<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\Term;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class TermEditorType extends SimpleEntityEditorType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('content', CKEditorType::class, array(
					'config' => array('uiColor' => '#ffffff'),
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
		return Term::class;
	}
}