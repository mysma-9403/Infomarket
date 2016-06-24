<?php

namespace AppBundle\Form;

use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Form\Base\BaseFormType;
use AppBundle\Form\Base\ImageEntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ProductCategoryAssignmentType extends BaseFormType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('product', EntityType::class, array(
					'class'			=> Product::class,
					'choice_label' 	=> 'name',
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'Choose product'
			))
			->add('segment', EntityType::class, array(
					'class'			=> Segment::class,
					'choice_label' 	=> 'name',
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'Choose segment'
			))
			->add('category', EntityType::class, array(
					'class'			=> Category::class,
					'choice_label' 	=> 'name',
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'Choose category'
			))
			->add('orderNumber', NumberType::class, array(
					'required' => true
			))
		;
	}
	
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return ProductCategoryAssignment::class;
	}
}