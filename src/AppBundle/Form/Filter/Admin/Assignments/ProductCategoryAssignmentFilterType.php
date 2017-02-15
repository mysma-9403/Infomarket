<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\ProductCategoryAssignmentFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductCategoryAssignmentFilterType extends AdminFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$products = $options['products'];
		$brands = $options['brands'];
		$segments = $options['segments'];
		$categories = $options['categories'];
		
		$featuredChoices = array(
				'label.all'			=> Filter::ALL_VALUES,
				'label.featured' 	=> Filter::TRUE_VALUES,
				'label.notFeatured' => Filter::FALSE_VALUES
		);
		
		$builder
		->add('products', ChoiceType::class, array(
				'choices' 		=> $products, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('brands', ChoiceType::class, array(
				'choices'		=> $brands,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('segments', ChoiceType::class, array(
				'choices'		=> $segments,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('categories', ChoiceType::class, array(
				'choices'		=> $categories, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('featured', ChoiceType::class, array(
				'choices'		=> $featuredChoices,
				'expanded'      => false,
				'multiple'      => false,
				'required' 		=> true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['products'] = array();
		$options['brands'] = array();
		$options['segments'] = array();
		$options['categories'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return ProductCategoryAssignmentFilter::class;
	}
}