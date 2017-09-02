<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\TermCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class TermCategoryAssignmentFilterType extends SimpleEntityFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'terms');
		$this->addFilterEntityChoiceField($builder, $options, 'categories');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('terms')] = [ ];
		$options[$this->getChoicesName('categories')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return TermCategoryAssignmentFilter::class;
	}
}