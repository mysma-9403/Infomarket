<?php

namespace AppBundle\Form;

use AppBundle\Entity\Product;
use AppBundle\Form\Base\SimpleEntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use AppBundle\Form\Base\ImageEntityType;

class ProductType extends ImageEntityType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
			->add('brand', EntityType::class, array(
					'class'			=> Brand::class,
					'choice_label' 	=> 'name',
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'Choose brand'
			))
			->add('category', EntityType::class, array(
					'class'			=> Category::class,
					'choice_label' 	=> 'name',
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'Choose category'
			))
			->add('price', IntegerType::class, array(
					'required' => false
			))
			->add('guarantee', IntegerType::class, array(
					'required' => false
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return Product::class;
	}
}