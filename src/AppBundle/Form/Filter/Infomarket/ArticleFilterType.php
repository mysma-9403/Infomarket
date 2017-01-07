<?php

namespace AppBundle\Form\Filter\Infomarket;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\ArticleCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleFilterType extends SimpleEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('articleCategories', EntityType::class, array(
				'class'			=> ArticleCategory::class,
				'query_builder' => function (ArticleCategoryRepository $repository) {
					return $repository->createQueryBuilder('e')
					->where('e.infomarket = ' . BaseEntityFilter::TRUE_VALUES)
					->orderBy('e.published DESC, e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => true,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.articleCategory'
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