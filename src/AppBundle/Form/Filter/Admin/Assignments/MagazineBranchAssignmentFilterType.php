<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\MagazineBranchAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class MagazineBranchAssignmentFilterType extends AdminFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addChoiceEntityFilterField($builder, $options, 'magazines');
		$this->addChoiceEntityFilterField($builder, $options, 'branches');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('magazines')] = [];
		$options[$this->getChoicesName('branches')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return MagazineBranchAssignmentFilter::class;
	}
}