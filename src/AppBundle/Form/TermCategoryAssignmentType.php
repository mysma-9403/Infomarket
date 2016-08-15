<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use AppBundle\Entity\Term;
use AppBundle\Entity\TermCategoryAssignment;
use AppBundle\Form\Base\BaseFormType;
use AppBundle\Form\Base\ImageEntityType;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\TermRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class TermCategoryAssignmentType extends BaseFormType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('term', EntityType::class, array(
					'class'			=> Term::class,
					'query_builder' => function (TermRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'choice_label' 	=> 'displayName',
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.term'
			))
			->add('category', EntityType::class, array(
					'class'			=> Category::class,
					'query_builder' => function (CategoryRepository $repository) {
						return $repository->createQueryBuilder('e')
						->where('e.preleaf = true')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'choice_label' 	=> 'displayName',
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.category'
			))
		;
	}
	
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return TermCategoryAssignment::class;
	}
}