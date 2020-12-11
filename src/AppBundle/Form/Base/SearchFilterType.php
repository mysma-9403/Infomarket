<?php

namespace AppBundle\Form\Base;

use AppBundle\Filter\Common\Search\SearchFilter;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchFilterType extends BaseType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		$builder->add('string', SearchType::class, 
				array('attr' => array('autofocus' => true, 'placeholder' => 'label.search.string'), 
						'required' => false));
	}

	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('search', SubmitType::class);
	}

	protected function getEntityType() {
		return SearchFilter::class;
	}
}