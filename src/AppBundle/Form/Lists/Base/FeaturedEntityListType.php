<?php

namespace AppBundle\Form\Lists\Base;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class FeaturedEntityListType extends InfoMarketEntityListType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addActions()
	 */
	protected function addActions(FormBuilderInterface $builder, array $options) {
		parent::addActions($builder, $options);
		
		$builder
		->add('setFeaturedSelected', SubmitType::class)
		->add('setNotFeaturedSelected', SubmitType::class)
		;
	}
}