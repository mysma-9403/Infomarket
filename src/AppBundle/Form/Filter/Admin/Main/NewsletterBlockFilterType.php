<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\NewsletterBlockFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockFilterType extends SimpleEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$newsletterPages = $options['newsletterPages'];
		$newsletterBlockTemplates = $options['newsletterBlockTemplates'];
		
		$builder
		->add('newsletterPages', ChoiceType::class, array(
				'choices'		=> $newsletterPages,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('newsletterBlockTemplates', ChoiceType::class, array(
				'choices'		=> $newsletterBlockTemplates, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['newsletterPages'] = array();
		$options['newsletterBlockTemplates'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockFilter::class;
	}
}