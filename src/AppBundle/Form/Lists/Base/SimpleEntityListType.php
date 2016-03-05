<?php

namespace AppBundle\Form\Lists\Base;

use AppBundle\Entity\Base\SimpleEntity;
use AppBundle\Entity\Lists\Base\SimpleEntityList;
use AppBundle\Form\Base\BaseFormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleEntityListType extends BaseFormType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('entries', EntityType::class, array(
					'class'			=> $this->getChoiceType(),
					'choice_label' 	=> 'name',
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
			->add('new', SubmitType::class)
			->add('selectAll', SubmitType::class)
			->add('selectNone', SubmitType::class)
			->add('deleteSelected', SubmitType::class)
			->add('publishSelected', SubmitType::class)
			->add('unpublishSelected', SubmitType::class)
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
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::getEntityType()
	 */
	protected function getEntityType() {
		return SimpleEntityList::class;
	}
	
	/**
	 * Get listed entitys' type.
	 *
	 * @return mixed (e.g <strong>Product::class</strong>)
	 */
	protected function getChoiceType() {
		return SimpleEntity::class;
	}
}