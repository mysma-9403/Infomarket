<?php

namespace AppBundle\Form\Lists;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\Lists\Base\FeaturedListType;

class CategoryListType extends FeaturedListType {

	protected function addActions(FormBuilderInterface $builder, array $options) {
		parent::addActions($builder, $options);
		
		$builder->add('bmPublishSelected', SubmitType::class)->add('bmUnpublishSelected', 
				SubmitType::class);
	}
}