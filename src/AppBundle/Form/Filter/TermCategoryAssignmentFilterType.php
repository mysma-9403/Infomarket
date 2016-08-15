<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\TermCategoryAssignmentFilter;
use AppBundle\Entity\Term;
use AppBundle\Form\Filter\Base\FilterFormType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\TermRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class TermCategoryAssignmentFilterType extends FilterFormType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('terms', EntityType::class, array(
				'class'			=> Term::class,
				'query_builder' => function (TermRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.published DESC, e.name', 'ASC');
				},
				'choice_label' 	=> 'name',
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'Choose term'
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
		return TermCategoryAssignmentFilter::class;
	}
}