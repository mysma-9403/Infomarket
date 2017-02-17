<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockTemplateEditorType extends SimpleEntityEditorType
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
					'attr' => array('rows' => '10'),
					'required' => true
			))
			->add('advertContent', TextareaType::class, array(
					'attr' => array('rows' => '10'),
					'required' => false
			))
			->add('articleContent', TextareaType::class, array(
					'attr' => array('rows' => '10'),
					'required' => false
			))
			->add('magazineContent', TextareaType::class, array(
					'attr' => array('rows' => '10'),
					'required' => false
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