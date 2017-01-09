<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\MenuEntryFilter;
use AppBundle\Entity\Link;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\Page;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Repository\LinkRepository;
use AppBundle\Repository\MenuEntryRepository;
use AppBundle\Repository\PageRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryFilterType extends SimpleEntityFilterType
{	
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
			->add('parents', EntityType::class, array(
				'class'			=> MenuEntry::class,
				'query_builder' => function (MenuEntryRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.treePath', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.menuEntry'
			))
			->add('pages', EntityType::class, array(
					'class'			=> Page::class,
					'query_builder' => function (PageRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
					},
					'required'		=> false,
					'expanded'      => false,
					'multiple'      => true,
					'placeholder'	=> 'label.choose.page'
			))
			->add('links', EntityType::class, array(
					'class'			=> Link::class,
					'query_builder' => function (LinkRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.name', 'ASC');
					},
					'required'		=> false,
					'expanded'      => false,
					'multiple'      => true,
					'placeholder'	=> 'label.choose.link'
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return MenuEntryFilter::class;
	}
}