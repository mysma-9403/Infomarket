<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\MagazineCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class MagazineCategoryAssignmentFilterType extends SimpleEntityFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addEntityChoiceFilterField($builder, $options, 'magazines');
		$this->addEntityChoiceFilterField($builder, $options, 'categories');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('magazines')] = [];
		$options[$this->getChoicesName('categories')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return MagazineCategoryAssignmentFilter::class;
	}
}