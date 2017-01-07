<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\Branch;
use AppBundle\Entity\BranchCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Repository\BranchRepository;
use AppBundle\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class BranchCategoryAssignmentEditorType extends BaseEntityEditorType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('branch', EntityType::class, array(
					'class'			=> Branch::class,
					'query_builder' => function (BranchRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.branch'
			))
			->add('category', EntityType::class, array(
					'class'			=> Category::class,
					'query_builder' => function (CategoryRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'required' 		=> false,
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
		return BranchCategoryAssignment::class;
	}
}