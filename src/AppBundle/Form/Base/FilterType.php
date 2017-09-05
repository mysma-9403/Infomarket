<?php

namespace AppBundle\Form\Base;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class FilterType extends BaseType {

	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('search', SubmitType::class)->add('clear', SubmitType::class);
	}
}