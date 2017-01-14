<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Entity\Segment;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\ProductRepository;
use AppBundle\Repository\SegmentRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductCategoryAssignmentEditorType extends BaseEntityEditorType
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
					'query_builder' => function (ProductRepository $repository) {
						return $repository->createQueryBuilder('e')
						->leftJoin(Brand::class, 'b', null, 'WITH b.id = e.brand')
						->orderBy('b.name ASC, e.name', 'ASC');
					},
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.product'
			))
			->add('segment', EntityType::class, array(
					'class'			=> Segment::class,
					'query_builder' => function (SegmentRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.id', 'ASC');
					},
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.segment'
			))
			->add('category', EntityType::class, array(
					'class'			=> Category::class,
					'query_builder' => function (CategoryRepository $repository) {
						return $repository->createQueryBuilder('e')
						->where('e.preleaf = false')
						->orderBy('e.name', 'ASC');
					},
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.category'
			))
			->add('orderNumber', NumberType::class, array(
					'required' => true
			))
			->add('featured', null, array(
					'required' => false
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