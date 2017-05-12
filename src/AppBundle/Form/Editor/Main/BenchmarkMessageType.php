<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Form\Base\BaseType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkMessageType extends BaseType
{
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
	
		$states = array(
				BenchmarkMessage::getStateName(BenchmarkMessage::IN_PROCESS_STATE) => BenchmarkMessage::IN_PROCESS_STATE,
				BenchmarkMessage::getStateName(BenchmarkMessage::INFORMATION_REQUIRED_STATE) => BenchmarkMessage::INFORMATION_REQUIRED_STATE,
				BenchmarkMessage::getStateName(BenchmarkMessage::COMPLETED_STATE) => BenchmarkMessage::COMPLETED_STATE
		);
		
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
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addActions()
	 */
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('save', SubmitType::class);
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