<?php

namespace AppBundle\Form\Filter\Base;

use AppBundle\Form\Base\BaseFormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class FilterFormType extends BaseFormType
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
	
		$builder
			->add('published', ChoiceType::class, array(
					'choices'		=> $publishChoices,
					'expanded'      => false,
					'multiple'      => false,
					'required' 		=> true
			))
			->add('updatedAfter', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datetimepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm'
					]
			))
			->add('updatedBefore', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm'
					]
			))
			->add('createdAfter', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm'
					]
			))
			->add('createdBefore', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm'
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
		->add('clear', SubmitType::class)
		;
	}
	
	protected function getEntityType() {
		return BaseEntityFilter::class;
	}
}