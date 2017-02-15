<?php

namespace AppBundle\Form\Lists\Base;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleEntityListType extends BaseEntityListType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addActions()
	 */
	protected function addActions(FormBuilderInterface $builder, array $options) {
		parent::addActions($builder, $options);
		
		$builder
		->add('imPublishSelected', SubmitType::class)
		->add('imUnpublishSelected', SubmitType::class)
		->add('ipPublishSelected', SubmitType::class)
		->add('ipUnpublishSelected', SubmitType::class)
		;
	}
}