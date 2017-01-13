<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\Branch;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuEntryBranchAssignment;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Repository\BranchRepository;
use AppBundle\Repository\MenuEntryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryBranchAssignmentEditorType extends BaseEntityEditorType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('menuEntry', EntityType::class, array(
					'class'			=> MenuEntry::class,
					'query_builder' => function (MenuEntryRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.name', 'ASC');
					},
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.menuEntry'
			))
			->add('branch', EntityType::class, array(
					'class'			=> Branch::class,
					'query_builder' => function (BranchRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.name', 'ASC');
					},
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.branch'
			))
		;
	}
	
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return MenuEntryBranchAssignment::class;
	}
}