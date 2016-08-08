<?php

namespace AppBundle\Form;

use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Form\Base\BaseFormType;
use AppBundle\Form\Base\ImageEntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Category;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Segment;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use AppBundle\Repository\BrandRepository;
use AppBundle\Repository\SegmentRepository;
use AppBundle\Repository\CategoryRepository;

class BrandCategoryAssignmentType extends BaseFormType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('brand', EntityType::class, array(
					'class'			=> Brand::class,
					'query_builder' => function (BrandRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'choice_label' 	=> 'displayName',
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.brand'
			))
			->add('segment', EntityType::class, array(
					'class'			=> Segment::class,
					'query_builder' => function (SegmentRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.id', 'ASC');
					},
					'choice_label' 	=> 'displayName',
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
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'choice_label' 	=> 'displayName',
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.category'
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
		return BrandCategoryAssignment::class;
	}
}