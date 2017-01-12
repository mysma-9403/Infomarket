<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\Link;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LinkEditorType extends SimpleEntityEditorType
{	
	/**
	 * {@inheritDoc}
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('url', TextType::class, array(
				'required' => true
		))
		;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Link::class;
	}
}