<?php

namespace AppBundle\Form\Editor\Main;

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
				Advert::getLocationName(Advert::TOP_LOCATION)  => Advert::TOP_LOCATION,
				Advert::getLocationName(Advert::SIDE_LOCATION)  => Advert::SIDE_LOCATION,
				Advert::getLocationName(Advert::TEXT_LOCATION)  => Advert::TEXT_LOCATION,
				Advert::getLocationName(Advert::FEATURED_LOCATION)  => Advert::FEATURED_LOCATION
		);
		
		$builder
			->add('location', ChoiceType::class, array(
					'choices'		=> $locationChoices,
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