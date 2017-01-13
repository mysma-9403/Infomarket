<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\Category;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuEntryCategoryAssignment;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\MenuEntryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryCategoryAssignmentEditorType extends BaseEntityEditorType
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
			->add('category', EntityType::class, array(
					'class'			=> Category::class,
					'query_builder' => function (CategoryRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.name', 'ASC');
					},
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
		return MenuEntryCategoryAssignment::class;
	}
}