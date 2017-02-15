<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\MenuMenuEntryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuMenuEntryAssignmentFilterType extends AdminFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$menus = $options['menus'];
		$menuEntries = $options['menuEntries'];
		
		$builder
		->add('menus', ChoiceType::class, array(
				'choices' 		=> $menus, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('menuEntries', ChoiceType::class, array(
				'choices'		=> $menuEntries, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['menus'] = array();
		$options['menuEntries'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return MenuMenuEntryAssignmentFilter::class;
	}
}