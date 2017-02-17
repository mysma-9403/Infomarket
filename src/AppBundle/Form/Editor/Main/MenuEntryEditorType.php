<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\Link;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\Page;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;
use AppBundle\Form\Editor\Transformer\LinkToNumberTransformer;
use AppBundle\Form\Editor\Transformer\MenuEntryToNumberTransformer;
use AppBundle\Form\Editor\Transformer\PageToNumberTransformer;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryEditorType extends SimpleEntityEditorType
{
	protected $em;
	
	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		/** @var MenuEntryRepository $menuEntryRepository */
		$menuEntryRepository = $this->em->getRepository(MenuEntry::class);
		$menuEntries = $menuEntryRepository->findFilterItems();
		
		/** @var PageRepository $pageRepository */
		$pageRepository = $this->em->getRepository(Page::class);
		$pages = $pageRepository->findFilterItems();
		
		/** @var LinkRepository $linkRepository */
		$linkRepository = $this->em->getRepository(Link::class);
		$links = $linkRepository->findFilterItems();
		
		$builder
		->add('orderNumber', null, array(
				'required' => true
		))
		->add('parent', ChoiceType::class, array(
				'choices' 		=> $menuEntries,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('page', ChoiceType::class, array(
				'choices' 		=> $pages,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('link', ChoiceType::class, array(
				'choices' 		=> $links,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => false
		))
		;
		
		$builder->get('parent')->addModelTransformer(new MenuEntryToNumberTransformer($this->em));
		$builder->get('page')->addModelTransformer(new PageToNumberTransformer($this->em));
		$builder->get('link')->addModelTransformer(new LinkToNumberTransformer($this->em));
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return MenuEntry::class;
	}
}