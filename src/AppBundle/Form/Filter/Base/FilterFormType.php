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
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.published' 	=> SimpleEntityFilter::TRUE_VALUES,
				'label.unpublished' => SimpleEntityFilter::FALSE_VALUES
		);
	
		$builder
			->add('published', ChoiceType::class, array(
					'choices'		=> $publishChoices,
					'expanded'      => false,
					'multiple'      => false,
					'required' 		=> true
			))
			->add('publishedAfter', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datetimepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm',
							'placeholder' => 'label.publishedAfter'
					]
			))
			->add('publishedBefore', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm',
							'placeholder' => 'label.publishedBefore'
					]
			))
			->add('updatedAfter', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datetimepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm',
							'placeholder' => 'label.updatedAfter'
					]
			))
			->add('updatedBefore', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm',
							'placeholder' => 'label.updatedBefore'
					]
			))
			->add('createdAfter', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm',
							'placeholder' => 'label.createdAfter'
					]
			))
			->add('createdBefore', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm',
							'placeholder' => 'label.createdBefore'
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