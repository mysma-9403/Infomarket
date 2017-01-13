<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Branch;
use AppBundle\Entity\Filter\MenuEntryBranchAssignmentFilter;
use AppBundle\Entity\MenuEntry;
use AppBundle\Form\Filter\Base\BaseEntityFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\BranchRepository;
use AppBundle\Repository\MenuEntryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryBranchAssignmentFilterType extends BaseEntityFilterType
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
		->add('branches', EntityType::class, array(
				'class'			=> Branch::class,
				'query_builder' => function (BranchRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.branch'
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return MenuEntryBranchAssignmentFilter::class;
	}
}