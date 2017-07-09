<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Menu;
use AppBundle\Entity\MenuMenuEntryAssignment;
use AppBundle\Entity\MenuEntry;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Utils\FormUtils;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Form\Editor\Transformer\MenuToNumberTransformer;
use AppBundle\Repository\Admin\Main\MenuRepository;
use AppBundle\Form\Editor\Transformer\MenuEntryToNumberTransformer;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MenuMenuEntryAssignmentEditorType extends BaseEntityEditorType
{
	protected $em;
	
	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
	
		/** @var MenuRepository $menuRepository */
		$menuRepository = $this->em->getRepository(Menu::class);
		$menus = $menuRepository->findFilterItems();
		
		/** @var MenuEntryRepository $menuEntryRepository */
		$menuEntryRepository = $this->em->getRepository(MenuEntry::class);
		$menuEntries = $menuEntryRepository->findFilterItems();
	
		$builder
		->add('menu', ChoiceType::class, array(
				'choices' 		=> $menus,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('menuEntry', ChoiceType::class, array(
				'choices'		=> $menuEntries,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('orderNumber', IntegerType::class, array(
				'required'		=> true
		))
		;
		
		$builder->get('menu')->addModelTransformer(new MenuToNumberTransformer($this->em));
		$builder->get('menuEntry')->addModelTransformer(new MenuEntryToNumberTransformer($this->em));
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return MenuMenuEntryAssignment::class;
	}
}