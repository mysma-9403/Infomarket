<?php

namespace AppBundle\Form;

use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Form\Base\SimpleEntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockTemplateType extends SimpleEntityType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
			->add('style', TextareaType::class, array(
					'attr' => array('rows' => '9'),
					'required' => false
			))
			->add('content', TextareaType::class, array(
					'attr' => array('rows' => '17'),
					'required' => true
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockTemplate::class;
	}
}