<?php

namespace AppBundle\Form\Lists\Base;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class FeaturedListType extends InfoMarketListType {

	protected function addActions(FormBuilderInterface $builder, array $options) {
		parent::addActions($builder, $options);
		
		$builder->add('setFeaturedSelected', SubmitType::class)->add('setNotFeaturedSelected', 
				SubmitType::class);
	}
}