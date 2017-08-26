<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\AdvertCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class AdvertCategoryAssignmentFilterType extends SimpleEntityFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'adverts');
		$this->addFilterEntityChoiceField($builder, $options, 'categories');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('adverts')] = [ ];
		$options[$this->getChoicesName('categories')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return AdvertCategoryAssignmentFilter::class;
	}
}