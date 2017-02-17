<?php

namespace AppBundle\Form\Filter\Admin\Base;

use AppBundle\Filter\Admin\Base\AuditFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Utils\FormUtils;

class AdminFilterType extends FilterType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
	
		$users = $options['users'];
		
		$builder
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
		->add('updatedBy', ChoiceType::class, array(
				'choices' 		=> $users,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('createdBy', ChoiceType::class, array(
				'choices' 		=> $users,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options['users'] = array();
	
		return $options;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::getEntityType()
	 */
	protected function getEntityType() {
		return AuditFilter::class;
	}
}