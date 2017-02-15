<?php

namespace AppBundle\Form\Base;

use AppBundle\Form\Base\BaseType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class ListType extends BaseType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$builder
		->add('entries', ChoiceType::class, array(
				'choices'		=> $options['choices'],
				'expanded'      => true,
				'multiple'      => true
		));
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addActions()
	 */
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder
			->add('selectAll', SubmitType::class)
			->add('selectNone', SubmitType::class)
			->add('deleteSelected', SubmitType::class)
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::initDefaultOptions()
	 */
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		$options['choices'] = array();
		
		return $options;
	}
}