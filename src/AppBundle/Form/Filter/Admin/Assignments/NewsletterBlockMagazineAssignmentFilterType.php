<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\NewsletterBlockMagazineAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockMagazineAssignmentFilterType extends AdminFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$newsletterBlocks = $options['newsletterBlocks'];
		$magazines = $options['magazines'];
		
		$builder
		->add('newsletterBlocks', ChoiceType::class, array(
				'choices' 		=> $newsletterBlocks, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('magazines', ChoiceType::class, array(
				'choices'		=> $magazines, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['newsletterBlocks'] = array();
		$options['magazines'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockMagazineAssignmentFilter::class;
	}
}