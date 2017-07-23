<?php

namespace AppBundle\Controller\Admin\Assignments;

use AppBundle\Controller\Admin\Base\AssignmentController;
use AppBundle\Controller\Admin\Base\BaseEntityController;
use AppBundle\Entity\Magazine;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockMagazineAssignment;
use AppBundle\Filter\Admin\Assignments\NewsletterBlockMagazineAssignmentFilter;
use AppBundle\Form\Editor\Admin\Assignments\NewsletterBlockMagazineAssignmentEditorType;
use AppBundle\Form\Filter\Admin\Assignments\NewsletterBlockMagazineAssignmentFilterType;
use AppBundle\Manager\Entity\Common\NewsletterBlockMagazineAssignmentManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockMagazineAssignmentController extends AssignmentController {
	
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
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
	
		$this->addEntityChoicesFormOption($options, NewsletterBlock::class, 'newsletterBlocks');
		$this->addEntityChoicesFormOption($options, Magazine::class, 'magazines');
	
		return $options;
	}
	
	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
	
		$this->addEntityChoicesFormOption($options, NewsletterBlock::class, 'newsletterBlock');
		$this->addEntityChoicesFormOption($options, Magazine::class, 'magazine');
	
		return $options;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getEntityManager()
	 */
	protected function getEntityManager($doctrine, $paginator) {
		return new NewsletterBlockMagazineAssignmentManager($doctrine, $paginator);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getFilterManager()
	 */
	protected function getFilterManager($doctrine) {
		return new FilterManager(new NewsletterBlockMagazineAssignmentFilter());
	}
	
	//------------------------------------------------------------------------
	// EntityType related
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseController::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockMagazineAssignment::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return NewsletterBlockMagazineAssignmentEditorType::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFilterFormType()
	 */
	 protected function getFilterFormType() {
		return NewsletterBlockMagazineAssignmentFilterType::class;
	}
}