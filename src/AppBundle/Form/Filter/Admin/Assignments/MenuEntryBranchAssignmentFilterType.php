<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\MenuEntryBranchAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryBranchAssignmentFilterType extends SimpleFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'menuEntries');
		$this->addFilterEntityChoiceField($builder, $options, 'branches');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('menuEntries')] = [ ];
		$options[$this->getChoicesName('branches')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return MenuEntryBranchAssignmentFilter::class;
	}
}