<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use AppBundle\Form\Base\ImageEntityType;
use AppBundle\Repository\CategoryRepository;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\Magazine;
use AppBundle\Repository\MagazineRepository;

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
					'required' => true
			))
			->add('icon', null, array(
					'required' => false
			))
			->add('iconImage', ElFinderType::class, array(
					'instance'=>'icon',
					'required' => false
			))
			->add('featuredImage', ElFinderType::class, array(
					'instance'=>'featured',
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
					'placeholder'	=> 'label.choose.category.parent'
			))
			->add('magazine', EntityType::class, array(
					'class'			=> Magazine::class,
					'query_builder' => function (MagazineRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
					},
					'choice_label' 	=> 'name',
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.magazine'
							))
			->add('preleaf', null, array(
					'required' => false
			))
			->add('featured', null, array(
					'required' => false
			))
			->add('content', CKEditorType::class, array(
					'config' => array(
							'uiColor' => '#ffffff'),
					'required' => false
			))
			;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Category::class;
	}
}