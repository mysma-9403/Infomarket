<?php

namespace AppBundle\Form\Filter\Admin\Base;

use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\Base\FilterType;

class SimpleEntityFilterType extends FilterType {
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
	
		$this->addDateTimeField($builder, 'createdAfter', 'label.createdAfter', false);
		$this->addDateTimeField($builder, 'createdBefore', 'label.createdBefore', false);
	
		$this->addDateTimeField($builder, 'updatedAfter', 'label.updatedAfter', false);
		$this->addDateTimeField($builder, 'updatedBefore', 'label.updatedBefore', false);
	
		$this->addEntityChoiceFilterField($builder, $options, 'createdBy');
		$this->addEntityChoiceFilterField($builder, $options, 'updatedBy');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[$this->getChoicesName('createdBy')] = [];
		$options[$this->getChoicesName('updatedBy')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return SimpleEntityFilter::class;
	}
}