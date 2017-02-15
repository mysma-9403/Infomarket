<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\ImageEntityController;
use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Magazine;
use AppBundle\Filter\Admin\Main\MagazineFilter;
use AppBundle\Form\Editor\MagazineEditorType;
use AppBundle\Form\Filter\Admin\Main\MagazineFilterType;
use AppBundle\Manager\Entity\Common\MagazineManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Repository\Admin\Main\BranchRepository;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Admin\Main\MagazineRepository;

class MagazineController extends ImageEntityController {
	
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
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setFeaturedAction(Request $request, $id)
	{
		return $this->setFeaturedActionInternal($request, $id);
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		/** @var MagazineRepository $magazineRepository */
		$magazineRepository = $this->getDoctrine()->getRepository(Magazine::class);
		$options['parents'] = $magazineRepository->findFilterItems();
		
		/** @var BranchRepository $branchRepository */
		$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
		$options['branches'] = $branchRepository->findFilterItems();
		
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$options['categories'] = $categoryRepository->findFilterItems();
	
		return $options;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getEntityManager($doctrine, $paginator) {
		return new MagazineManager($doctrine, $paginator);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new MagazineFilter());
	}
	
	
	//------------------------------------------------------------------------
	// EntityType related
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return Magazine::class;
	}
	
	
	//------------------------------------------------------------------------
	// Forms
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return MagazineEditorType::class;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFilterFormType()
	 */
	protected function getFilterFormType() {
		return MagazineFilterType::class;
	}
}