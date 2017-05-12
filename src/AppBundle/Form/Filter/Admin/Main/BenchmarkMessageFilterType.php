<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Filter\Admin\Main\BenchmarkMessageFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use AppBundle\Utils\FormUtils;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkMessageFilterType extends AdminFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreMessages()
	 */
	protected function addMainMessages(FormBuilderInterface $builder, array $options) {
		parent::addMainMessages($builder, $options);
		
		$products = $options['products'];
		$users = $options['users'];
		
		$states = array(
				BenchmarkMessage::getStateName(BenchmarkMessage::REPORTED_STATE) => BenchmarkMessage::REPORTED_STATE,
				BenchmarkMessage::getStateName(BenchmarkMessage::IN_PROCESS_STATE) => BenchmarkMessage::IN_PROCESS_STATE,
				BenchmarkMessage::getStateName(BenchmarkMessage::INFORMATION_REQUIRED_STATE) => BenchmarkMessage::INFORMATION_REQUIRED_STATE,
				BenchmarkMessage::getStateName(BenchmarkMessage::INFORMATION_SUPPLIED_STATE) => BenchmarkMessage::INFORMATION_SUPPLIED_STATE,
				BenchmarkMessage::getStateName(BenchmarkMessage::COMPLETED_STATE) => BenchmarkMessage::COMPLETED_STATE
		);
		
		$readByAdminChoices = array(
				'label.all'	=> Filter::ALL_VALUES,
				'label.read' => Filter::TRUE_VALUES,
				'label.unread' => Filter::FALSE_VALUES
		);
		
		$builder
		->add('products', ChoiceType::class, array(
				'choices'		=> $products, 
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('authors', ChoiceType::class, array(
				'choices'		=> $users,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('states', ChoiceType::class, array(
				'choices'		=> $states,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('readByAdmin', ChoiceType::class, array(
				'choices'		=> $readByAdminChoices,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['products'] = array();
		$options['users'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return BenchmarkMessageFilter::class;
	}
}