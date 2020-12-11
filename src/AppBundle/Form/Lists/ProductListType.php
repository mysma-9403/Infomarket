<?php

namespace AppBundle\Form\Lists;

use AppBundle\Form\Lists\Base\InfoMarketListType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductListType extends InfoMarketListType {

	protected function addActions(FormBuilderInterface $builder, array $options) {
		parent::addActions($builder, $options);
		
		$builder->add('bmPublishSelected', SubmitType::class)->add('bmUnpublishSelected', 
				SubmitType::class);
	}
}