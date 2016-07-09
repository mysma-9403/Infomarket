<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ProductCategoryAssignmentFilter;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Form\Filter\Base\FilterFormType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\ProductRepository;
use AppBundle\Repository\SegmentRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductCategoryAssignmentFilterType extends FilterFormType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('products', EntityType::class, array(
				'class'			=> Product::class,
				'query_builder' => function (ProductRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.published DESC, e.name', 'ASC');
				},
				'choice_label' 	=> 'name',
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'Choose product'
		))
		->add('segments', EntityType::class, array(
				'class'			=> Segment::class,
				'query_builder' => function (SegmentRepository $repository) {
				return $repository->createQueryBuilder('e')
				->orderBy('e.published DESC, e.name', 'ASC');
				},
				'choice_label' 	=> 'name',
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'Choose segment'
		))
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
				'placeholder'	=> 'Choose category'
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