<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\MenuMenuEntryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuMenuEntryAssignmentFilterType extends AdminFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addChoiceEntityFilterField($builder, $options, 'menus');
		$this->addChoiceEntityFilterField($builder, $options, 'menuEntries');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('menus')] = [];
		$options[$this->getChoicesName('menuEntries')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return MenuMenuEntryAssignmentFilter::class;
	}
}