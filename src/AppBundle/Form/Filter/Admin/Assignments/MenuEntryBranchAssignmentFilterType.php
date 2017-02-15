<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\MenuEntryBranchAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryBranchAssignmentFilterType extends AdminFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$menuEntries = $options['menuEntries'];
		$branches = $options['branches'];
		
		$builder
		->add('menuEntries', ChoiceType::class, array(
				'choices' 		=> $menuEntries, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('branches', ChoiceType::class, array(
				'choices'		=> $branches, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['menuEntries'] = array();
		$options['branches'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return MenuEntryBranchAssignmentFilter::class;
	}
}