<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\NewsletterUserFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NewsletterUserFilterType extends SimpleEntityFilterType
{	
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$subscribedChoices = array(
				'label.all'							=> SimpleEntityFilter::ALL_VALUES,
				'label.newsletter.subscribed' 		=> SimpleEntityFilter::TRUE_VALUES,
				'label.newsletter.unsubscribed' 	=> SimpleEntityFilter::FALSE_VALUES
		);
	
		$builder
			->add('subscribed', ChoiceType::class, array(
					'choices'		=> $subscribedChoices,
					'expanded'      => false,
					'multiple'      => false,
					'required' 		=> true
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