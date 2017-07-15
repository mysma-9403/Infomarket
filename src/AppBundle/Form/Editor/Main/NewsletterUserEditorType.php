<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterUserEditorType extends SimpleEntityEditorType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('subscribed', CheckboxType::class, array(
					'required' => false
			))
			;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterUser::class;
	}
}