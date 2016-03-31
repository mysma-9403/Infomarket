<?php

namespace AppBundle\Form\Filter\Base;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Form\Base\BaseFormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleEntityFilterType extends BaseFormType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$publishChoices = array(
				'All'			=> SimpleEntityFilter::ALL_VALUES,
				'Published' 	=> SimpleEntityFilter::TRUE_VALUES,
				'Unpublished' 	=> SimpleEntityFilter::FALSE_VALUES
		);
		
		$builder->setMethod('POST');
		
		$builder
			->add('name', TextType::class, array(
					'attr' => array('autofocus' => true),
					'required' => false
			))
			->add('published', ChoiceType::class, array(
					'placeholder'	=> 'All',
					'choices'		=> $publishChoices,
					'expanded'      => false,
					'multiple'      => false,
					'required' 		=> false
			))
			->add('updatedAfter', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'DD-MM-YYYY hh:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datetimepicker',
							'data-date-format' => 'DD-MM-YYYY hh:mm'
					]
			))
			->add('updatedBefore', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'DD-MM-YYYY hh:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datepicker',
							'data-date-format' => 'DD-MM-YYYY hh:mm'
					]
			))
			->add('createdAfter', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'DD-MM-YYYY hh:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datepicker',
							'data-date-format' => 'DD-MM-YYYY hh:mm'
					]
			))
			->add('createdBefore', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'DD-MM-YYYY hh:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datepicker',
							'data-date-format' => 'DD-MM-YYYY hh:mm'
					]
			))
		;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addActions()
	 */
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder
			->add('search', SubmitType::class)
			->add('clear', SubmitType::class);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::getEntityType()
	 */
	protected function getEntityType() {
		return SimpleEntityFilter::class;
	}
}