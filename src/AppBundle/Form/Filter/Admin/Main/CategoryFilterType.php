<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\CategoryFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Utils\FormUtils;

class CategoryFilterType extends SimpleEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$parents = $options['parents'];
		$branches = $options['branches'];
		
		$featuredChoices = array(
				'label.all'			=> Filter::ALL_VALUES,
				'label.featured' 	=> Filter::TRUE_VALUES,
				'label.notFeatured' => Filter::FALSE_VALUES
		);
		
		$preleafChoices = array(
				'label.all'			=> Filter::ALL_VALUES,
				'label.preleaf' 	=> Filter::TRUE_VALUES,
				'label.notPreleaf' => Filter::FALSE_VALUES
		);
		
		$builder
		->add('parents', ChoiceType::class, array(
				'choices'		=> $parents,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('branches', ChoiceType::class, array(
				'choices'		=> $branches,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('featured', ChoiceType::class, array(
				'choices'		=> $featuredChoices,
				'choice_translation_domain' => false,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('preleaf', ChoiceType::class, array(
				'choices'		=> $preleafChoices,
				'choice_translation_domain' => false,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('subname', TextType::class, array(
				'attr' => array(
						'placeholder' => 'label.subname'
				),
				'required' => false
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['parents'] = array();
		$options['branches'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return CategoryFilter::class;
	}
}