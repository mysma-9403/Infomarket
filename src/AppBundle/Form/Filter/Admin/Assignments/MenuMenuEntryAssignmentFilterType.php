<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\MenuMenuEntryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuMenuEntryAssignmentFilterType extends SimpleFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'menus');
		$this->addFilterEntityChoiceField($builder, $options, 'menuEntries');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('menus')] = [ ];
		$options[$this->getChoicesName('menuEntries')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return MenuMenuEntryAssignmentFilter::class;
	}
}