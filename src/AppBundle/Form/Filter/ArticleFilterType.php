<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Form\Filter\Base\ImageEntityFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\ArticleCategoryRepository;
use AppBundle\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleFilterType extends ImageEntityFilterType
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
		
		$mainChoices = array(
				'label.all'					=> SimpleEntityFilter::ALL_VALUES,
				'label.article.main' 		=> SimpleEntityFilter::TRUE_VALUES,
				'label.article.children' 	=> SimpleEntityFilter::FALSE_VALUES
		);
	
		$builder
		->add('articleCategories', EntityType::class, array(
				'class'			=> ArticleCategory::class,
				'query_builder' => function (ArticleCategoryRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.published DESC, e.name', 'ASC');
				},
				'choice_label' 	=> 'name',
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'Choose article category'
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
		->add('featured', ChoiceType::class, array(
				'choices'		=> $featuredChoices,
				'expanded'      => false,
				'multiple'      => false,
				'required' 		=> true
		))
		->add('main', ChoiceType::class, array(
				'choices'		=> $mainChoices,
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
		return ArticleFilter::class;
	}
}