<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ProductFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\Filter\Base\ImageEntityFilterType;

class ProductFilterType extends ImageEntityFilterType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('categories', EntityType::class, array(
					'class'			=> Category::class,
					'choice_label' 	=> 'name',
					'required'		=> false,
					'expanded'      => false,
					'multiple'      => true,
					'placeholder'	=> 'Choose category'
			))
			->add('brands', EntityType::class, array(
					'class'			=> Brand::class,
					'choice_label' 	=> 'name',
					'required'		=> false,
					'expanded'      => false,
					'multiple'      => true,
					'placeholder'	=> 'Choose brand'
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return ProductFilter::class;
	}
}