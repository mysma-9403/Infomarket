<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\NewsletterUserNewsletterPageAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Utils\FormUtils;

class NewsletterUserNewsletterPageAssignmentFilterType extends AdminFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$newsletterUsers = $options['newsletterUsers'];
		$newsletterPages = $options['newsletterPages'];
		
		$builder
		->add('newsletterUsers', ChoiceType::class, array(
				'choices' 		=> $newsletterUsers, 
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('newsletterPages', ChoiceType::class, array(
				'choices'		=> $newsletterPages, 
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['newsletterUsers'] = array();
		$options['newsletterPages'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterUserNewsletterPageAssignmentFilter::class;
	}
}