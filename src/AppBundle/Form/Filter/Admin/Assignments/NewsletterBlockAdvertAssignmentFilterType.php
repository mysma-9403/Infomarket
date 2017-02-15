<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\NewsletterBlockAdvertAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockAdvertAssignmentFilterType extends AdminFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$newsletterBlocks = $options['newsletterBlocks'];
		$adverts = $options['adverts'];
		
		$builder
		->add('newsletterBlocks', ChoiceType::class, array(
				'choices' 		=> $newsletterBlocks, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('adverts', ChoiceType::class, array(
				'choices'		=> $adverts, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['newsletterBlocks'] = array();
		$options['adverts'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockAdvertAssignmentFilter::class;
	}
}