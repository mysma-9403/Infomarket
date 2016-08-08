<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Filter\AdvertFilter;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Form\Filter\Base\ImageEntityFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Category;
use AppBundle\Repository\CategoryRepository;

class AdvertFilterType extends ImageEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$locationChoices = array(
				'label.advert.location.top'			=> Advert::TOP_LOCATION,
				'label.advert.location.side'		=> Advert::SIDE_LOCATION,
				'label.advert.location.text'		=> Advert::TEXT_LOCATION,
				'label.advert.location.featured'	=> Advert::FEATURED_LOCATION
		);
		
		$activeChoices = array(
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.active' 		=> SimpleEntityFilter::TRUE_VALUES,
				'label.inactive' 	=> SimpleEntityFilter::FALSE_VALUES
		);
	
		$builder
		->add('categories', EntityType::class, array(
				'class'			=> Category::class,
				'query_builder' => function (CategoryRepository $repository) {
				return $repository->createQueryBuilder('e')
				->orderBy('e.published DESC, e.name', 'ASC');
				},
				'choice_label' 	=> 'name',
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.category'
		))
		->add('locations', ChoiceType::class, array(
				'choices'		=> $locationChoices,
				'expanded'      => false,
				'multiple'      => true,
				'required'      => false,
				'placeholder'	=> 'label.choose.locations'
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
				'required' => false
		))
		->add('showCount', NumberType::class, array(
				'required' => false
		))
		->add('showLimit', NumberType::class, array(
				'required' => false
		))
		->add('clickCount', NumberType::class, array(
				'required' => false
		))
		->add('clickLimit', NumberType::class, array(
				'required' => false
		))
		->add('active', ChoiceType::class, array(
				'choices'		=> $activeChoices,
				'expanded'      => false,
				'multiple'      => false,
				'required' 		=> true
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return AdvertFilter::class;
	}
}