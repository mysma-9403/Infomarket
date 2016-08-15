<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Article;
use AppBundle\Entity\Tag;
use AppBundle\Entity\Filter\ArticleTagAssignmentFilter;
use AppBundle\Form\Filter\Base\FilterFormType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Repository\TagRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleTagAssignmentFilterType extends FilterFormType
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
		->add('tags', EntityType::class, array(
				'class'			=> Tag::class,
				'query_builder' => function (TagRepository $repository) {
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
		return ArticleTagAssignmentFilter::class;
	}
}