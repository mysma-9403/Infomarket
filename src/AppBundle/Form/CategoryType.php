<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Base\ImageEntityType;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Entity\Brand;
use AppBundle\Repository\BrandRepository;

class CategoryType extends ImageEntityType
{
	/**
	 * {@inheritDoc}
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('subname', null, array(
					'required' => false
			))
			->add('orderNumber', null, array(
					'required' => false
			))
			->add('icon', null, array(
					'required' => false
			))
			->add('parent', EntityType::class, array(
					'class'			=> $this->getEntityType(),
					'query_builder' => function (CategoryRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.name', 'ASC');
					},
					'choice_label' 	=> 'name',
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'Choose parent'
			))
			->add('published', null, array(
					'required' => false
			))
			->add('preleaf', null, array(
					'required' => false
			))
			->add('featured', null, array(
					'required' => false
			))
			->add('content', null, array(
					'attr' => array(
							'class' => 'tinymce',
							'data-theme' => 'bbcode',
							'rows' => 20),
					'required' => false
			))
			
			
			
			
			//TODO move to CategoryRank
// 			->add('brand1_1', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 						return $repository->createQueryBuilder('e')
// 						->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand1_2', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand1_3', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand1_4', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand1_5', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
			
			
			
			
// 			->add('brand2_1', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand2_2', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand2_3', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand2_4', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand2_5', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
			
			
			
// 			->add('brand3_1', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand3_2', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand3_3', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand3_4', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand3_5', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
			
			
			
// 			->add('brand4_1', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand4_2', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand4_3', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand4_4', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
// 			->add('brand4_5', EntityType::class, array(
// 					'class'			=> Brand::class,
// 					'query_builder' => function (BrandRepository $repository) {
// 					return $repository->createQueryBuilder('e')
// 					->orderBy('e.name', 'ASC');
// 					},
// 					'choice_label' 	=> 'name',
// 					'required' 		=> false,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'placeholder'	=> 'Choose brand'
// 			))
			;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => $this->getEntityClass(),
				'choices' => array(),
		));
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityClass() {
		return Category::class;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityName() {
		return 'category';
	}
	
	protected function getEntityType() {
		return 'AppBundle:Category';
	}
}