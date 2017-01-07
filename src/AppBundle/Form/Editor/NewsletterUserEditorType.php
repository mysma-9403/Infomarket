<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterUserEditorType extends SimpleEntityEditorType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
	
		$builder
		->add('name', EmailType::class, array(
				'attr' => array('autofocus' => false),
				'required' => true
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('subscribed', null, array(
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