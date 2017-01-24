<?php

namespace AppBundle\Form\Filter\Infomarket;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\ArticleCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\Category;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Entity\BranchCategoryAssignment;

class ArticleFilterType extends SimpleEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		$branch = $options['branch'];
		
		$builder
		->add('articleCategories', EntityType::class, array(
				'class'			=> ArticleCategory::class,
				'query_builder' => function (ArticleCategoryRepository $repository) {
					return $repository->createQueryBuilder('e')
					->where('e.infomarket = ' . BaseEntityFilter::TRUE_VALUES)
					->orderBy('e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => true,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.articleCategory'
		))
		->add('categories', EntityType::class, array(
				'class'			=> Category::class,
				'query_builder' => function (CategoryRepository $repository) use(&$branch) {
					return $repository->createQueryBuilder('e')
					->join(BranchCategoryAssignment::class, 'bca', 'WITH', 'e.id = bca.category')
					->where('e.infomarket = ' . BaseEntityFilter::TRUE_VALUES . ' AND e.parent IS NULL AND bca.branch = ' . $branch)
					->orderBy('e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => true,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.category'
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		$options['branch'] = 1;
	
		return $options;
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