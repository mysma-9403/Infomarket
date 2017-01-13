<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\MenuEntryCategoryAssignmentFilter;
use AppBundle\Entity\MenuEntry;
use AppBundle\Form\Filter\Base\BaseEntityFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\MenuEntryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryCategoryAssignmentFilterType extends BaseEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('menuEntries', EntityType::class, array(
				'class'			=> MenuEntry::class,
				'query_builder' => function (MenuEntryRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.menuEntry'
		))
		->add('categories', EntityType::class, array(
				'class'			=> Category::class,
				'query_builder' => function (CategoryRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.category'
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return MenuEntryCategoryAssignmentFilter::class;
	}
}