<?php

namespace AppBundle\Form\Filter\Admin\Base;

use AppBundle\Filter\Common\Base\SimpleEntityFilter;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\Base\FilterType;

class SimpleEntityFilterType extends FilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterDateTimeField($builder, 'createdAfter', 'label.createdAfter');
		$this->addFilterDateTimeField($builder, 'createdBefore', 'label.createdBefore');
		
		$this->addFilterDateTimeField($builder, 'updatedAfter', 'label.updatedAfter');
		$this->addFilterDateTimeField($builder, 'updatedBefore', 'label.updatedBefore');
		
		$this->addFilterEntityChoiceField($builder, $options, 'createdBy');
		$this->addFilterEntityChoiceField($builder, $options, 'updatedBy');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('createdBy')] = [ ];
		$options[$this->getChoicesName('updatedBy')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return SimpleEntityFilter::class;
	}
}