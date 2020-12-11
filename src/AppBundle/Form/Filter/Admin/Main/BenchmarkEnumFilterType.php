<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\BenchmarkEnumFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkEnumFilterType extends SimpleFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
	}

	protected function getEntityType() {
		return BenchmarkEnumFilter::class;
	}
}