<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\Advert;
use AppBundle\Form\Editor\Base\ImageEntityEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
		
		$locationChoices = array(
				'label.advert.location.top'			=> Advert::TOP_LOCATION,
				'label.advert.location.side'		=> Advert::SIDE_LOCATION,
				'label.advert.location.text'		=> Advert::TEXT_LOCATION,
				'label.advert.location.featured'	=> Advert::FEATURED_LOCATION
		);
		
		$builder
			->add('location', ChoiceType::class, array(
					'choices'		=> $locationChoices,
					'expanded'      => false,
					'multiple'      => false,
					'required'      => true,
					'placeholder' => 'label.choose.location'
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
			->add('showLimit', NumberType::class, array(
					'required' => false,
					'attr' => ['placeholder' => 'label.advert.showLimit']
			))
			->add('clickLimit', NumberType::class, array(
					'required' => false,
					'attr' => ['placeholder' => 'label.advert.clickLimit']
			))
		;
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