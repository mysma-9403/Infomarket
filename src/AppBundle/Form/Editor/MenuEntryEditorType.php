<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\Link;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\Page;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;
use AppBundle\Repository\LinkRepository;
use AppBundle\Repository\MenuEntryRepository;
use AppBundle\Repository\PageRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryEditorType extends SimpleEntityEditorType
{
	/**
	 * {@inheritDoc}
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('orderNumber', null, array(
				'required' => true
		))
		->add('parent', EntityType::class, array(
				'class'			=> $this->getEntityType(),
				'query_builder' => function (MenuEntryRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
				},
				'required' 		=> false,
				'expanded'      => false,
				'multiple'      => false,
				'placeholder'	=> 'label.choose.category.parent'
		))
		->add('page', EntityType::class, array(
				'class'			=> Page::class,
				'query_builder' => function (PageRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
				},
				'required' 		=> false,
				'expanded'      => false,
				'multiple'      => false,
				'placeholder'	=> 'label.choose.page'
		))
		->add('link', EntityType::class, array(
				'class'			=> Link::class,
				'query_builder' => function (LinkRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
				},
				'required' 		=> false,
				'expanded'      => false,
				'multiple'      => false,
				'placeholder'	=> 'label.choose.link'
		))
		;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return MenuEntry::class;
	}
}