<?php

namespace AppBundle\Form\Lists;

use AppBundle\Form\Lists\Base\BaseEntityListType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkMessageListType extends BaseEntityListType {	
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		parent::addActions($builder, $options);
		
		$builder
		->add('setReadSelected', SubmitType::class)
		->add('setUnreadSelected', SubmitType::class)
		;
	}
}