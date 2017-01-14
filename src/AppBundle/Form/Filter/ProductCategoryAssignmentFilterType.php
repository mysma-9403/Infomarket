<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ProductCategoryAssignmentFilter;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Form\Filter\Base\BaseEntityFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\ProductRepository;
use AppBundle\Repository\SegmentRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;

class ProductCategoryAssignmentFilterType extends BaseEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$featuredChoices = array(
				'label.all'			=> SimpleEntityFilter::ALL_VALUES,
				'label.featured' 	=> SimpleEntityFilter::TRUE_VALUES,
				'label.notFeatured' => SimpleEntityFilter::FALSE_VALUES
		);
		
		$builder
		->add('products', EntityType::class, array(
				'class'			=> Product::class,
				'query_builder' => function (ProductRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.product'
		))
		->add('segments', EntityType::class, array(
				'class'			=> Segment::class,
				'query_builder' => function (SegmentRepository $repository) {
				return $repository->createQueryBuilder('e')
				->orderBy('e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.segment'
		))
		->add('categories', EntityType::class, array(
				'class'			=> Category::class,
				'query_builder' => function (CategoryRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.category'
		))
		->add('featured', ChoiceType::class, array(
				'choices'		=> $featuredChoices,
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
		return ProductCategoryAssignmentFilter::class;
	}
}