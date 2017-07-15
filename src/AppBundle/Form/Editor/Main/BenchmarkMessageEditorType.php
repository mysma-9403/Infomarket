<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Form\Base\EditorType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkMessageEditorType extends EditorType
{
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		$states = $options['states'];
		
		$builder
		->add('state', ChoiceType::class, array(
				'choices'		=> $states,
				'expanded'      => true,
				'multiple'      => false,
				'required'      => true
		))
		->add('name', TextType::class, array(
				'required' => true
		))
		->add('content', CKEditorType::class, array(
				'config' => array('uiColor' => '#ffffff'),
				'required' => true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options['states'] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return BenchmarkMessage::class;
	}
}