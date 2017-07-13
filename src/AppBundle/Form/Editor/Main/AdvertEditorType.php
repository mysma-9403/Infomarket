<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\Advert;
use AppBundle\Form\Editor\Base\ImageEntityEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AdvertEditorType extends ImageEntityEditorType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$locations = $options['locations'];
		
		$builder
			->add('location', ChoiceType::class, array(
					'choices'		=> $locations,
					'expanded'      => false,
					'multiple'      => false,
					'required'      => true
			))
			->add('dateFrom', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datetimepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm',
							'placeholder' => 'label.advert.dateFrom'
					]
			))
			->add('dateTo', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datetimepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm',
							'placeholder' => 'label.advert.dateTo'
					]
			))
			->add('link', TextType::class, array(
					'required' => true,
					'attr' => ['placeholder' => 'label.advert.link']
			))
			->add('showLimit', IntegerType::class, array(
					'required' => false,
					'attr' => ['placeholder' => 'label.advert.showLimit']
			))
			->add('clickLimit', IntegerType::class, array(
					'required' => false,
					'attr' => ['placeholder' => 'label.advert.clickLimit']
			))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options['locations'] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return Advert::class;
	}
}