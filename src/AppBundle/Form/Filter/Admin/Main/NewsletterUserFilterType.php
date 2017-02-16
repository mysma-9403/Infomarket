<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\NewsletterUserFilter;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;

class NewsletterUserFilterType extends SimpleEntityFilterType
{
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		parent::addMoreFields($builder, $options);
		
		$subscribedChoices = array(
				'label.all'						=> Filter::ALL_VALUES,
				'label.newsletter.subscribed' 	=> Filter::TRUE_VALUES,
				'label.newsletter.unsubscribed' => Filter::FALSE_VALUES
		);
	
		$builder
		->add('subscribed', ChoiceType::class, array(
				'choices'		=> $subscribedChoices,
				'expanded'      => false,
				'multiple'      => false
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterUserFilter::class;
	}
}