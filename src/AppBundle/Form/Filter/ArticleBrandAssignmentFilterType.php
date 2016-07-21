<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Article;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Filter\ArticleBrandAssignmentFilter;
use AppBundle\Form\Filter\Base\FilterFormType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Repository\BrandRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleBrandAssignmentFilterType extends FilterFormType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('articles', EntityType::class, array(
				'class'			=> Article::class,
				'query_builder' => function (ArticleRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.published DESC, e.name', 'ASC');
				},
				'choice_label' 	=> 'name',
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'Choose article'
		))
		->add('brands', EntityType::class, array(
				'class'			=> Brand::class,
				'query_builder' => function (BrandRepository $repository) {
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
		return ArticleBrandAssignmentFilter::class;
	}
}