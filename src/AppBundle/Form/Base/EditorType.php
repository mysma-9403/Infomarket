<?php

namespace AppBundle\Form\Base;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class EditorType extends BaseType {

	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('save', SubmitType::class);
	}
}