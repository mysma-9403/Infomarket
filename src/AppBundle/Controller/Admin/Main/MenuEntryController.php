<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Menu;
use AppBundle\Entity\MenuEntry;
use AppBundle\Filter\Admin\Main\MenuEntryFilter;
use AppBundle\Form\Editor\Admin\Main\MenuEntryEditorType;
use AppBundle\Form\Filter\Admin\Main\MenuEntryFilterType;
use AppBundle\Manager\Entity\Common\MenuEntryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Base\BaseType;
use AppBundle\Repository\Admin\Main\PageRepository;
use AppBundle\Entity\Page;
use AppBundle\Repository\Admin\Main\LinkRepository;
use AppBundle\Entity\Link;

class MenuEntryController extends SimpleEntityController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	/**
	 * 
	 * @param Request $request
	 * @param integer $page
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function newAction(Request $request)
	{
		return $this->newActionInternal($request);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function copyAction(Request $request, $id)
	{
		return $this->copyActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, $id)
	{
		return $this->editActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id)
	{
		return $this->deleteActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIMPublishedAction(Request $request, $id)
	{
		return $this->setIMPublishedActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIPPublishedAction(Request $request, $id)
	{
		return $this->setIPPublishedActionInternal($request, $id);
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
	
		/** @var MenuRepository $menuRepository */
		$menuRepository = $this->getDoctrine()->getRepository(Menu::class);
		$options[BaseType::getChoicesName('menus')] = $menuRepository->findFilterItems();
		
		/** @var MenuEntryRepository $menuEntryRepository */
		$menuEntryRepository = $this->getDoctrine()->getRepository(MenuEntry::class);
		$options[BaseType::getChoicesName('parents')] = $menuEntryRepository->findFilterItems();
	
		/** @var BranchRepository $branchRepository */
		$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
		$options[BaseType::getChoicesName('branches')] = $branchRepository->findFilterItems();
	
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$options[BaseType::getChoicesName('categories')] = $categoryRepository->findFilterItems();
	
		/** @var ChoicesFactory $infomarketChoicesFactory */
		$infomarketChoicesFactory = $this->get('app.factory.choices.base.filter.infomarketChoices');
		$options[BaseType::getChoicesName('infomarket')] = $infomarketChoicesFactory->getItems();
		
		/** @var ChoicesFactory $infoproduktChoicesFactory */
		$infoproduktChoicesFactory = $this->get('app.factory.choices.base.filter.infoproduktChoices');
		$options[BaseType::getChoicesName('infoprodukt')] = $infoproduktChoicesFactory->getItems();
		
		return $options;
	}
	
	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
	
		/** @var MenuEntryRepository $menuEntryRepository */
		$menuEntryRepository = $this->getDoctrine()->getRepository(MenuEntry::class);
		$options[BaseType::getChoicesName('parent')] = $menuEntryRepository->findFilterItems();
	
		/** @var PageRepository $pageRepository */
		$pageRepository = $this->getDoctrine()->getRepository(Page::class);
		$options[BaseType::getChoicesName('page')] = $pageRepository->findFilterItems();
	
		/** @var LinkRepository $linkRepository */
		$linkRepository = $this->getDoctrine()->getRepository(Link::class);
		$options[BaseType::getChoicesName('link')] = $linkRepository->findFilterItems();
	
		return $options;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getEntityManager($doctrine, $paginator) {
		return new MenuEntryManager($doctrine, $paginator);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new MenuEntryFilter());
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return MenuEntry::class;
	}
	
	
	//---------------------------------------------------------------------------
	// Forms
	//---------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return MenuEntryEditorType::class;
	}

	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFilterFormType()
	 */
	protected function getFilterFormType() {
		return MenuEntryFilterType::class;
	}
}