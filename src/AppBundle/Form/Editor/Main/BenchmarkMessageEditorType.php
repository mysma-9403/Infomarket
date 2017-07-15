<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Form\Base\EditorType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
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
		
		$builder
		->add('name', TextType::class, array(
				'required' => true
		))
		->add('content', CKEditorType::class, array(
				'config' => array('uiColor' => '#ffffff'),
				'required' => true
		))
		;
		
		$this->addChoiceNumberField($builder, $options, 'state');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('state')] = [];
	
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