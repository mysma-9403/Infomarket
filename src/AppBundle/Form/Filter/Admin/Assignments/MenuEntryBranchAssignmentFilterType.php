<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\MenuEntryBranchAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryBranchAssignmentFilterType extends AdminFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addChoiceEntityFilterField($builder, $options, 'menuEntries');
		$this->addChoiceEntityFilterField($builder, $options, 'branches');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('menuEntries')] = [];
		$options[$this->getChoicesName('branches')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return MenuEntryBranchAssignmentFilter::class;
	}
}