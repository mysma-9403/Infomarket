<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Filter\Admin\Main\NewsletterUserFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterUserFilterType extends SimpleEntityFilterType
{
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		parent::addMoreFields($builder, $options);
		
		$subscribedChoices = array(
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.newsletter.subscribed' 	=> SimpleEntityFilter::TRUE_VALUES,
				'label.newsletter.unsubscribed' => SimpleEntityFilter::FALSE_VALUES
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