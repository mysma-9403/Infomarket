<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\BaseEntityController;
use AppBundle\Entity\NewsletterBlockArticleAssignment;
use AppBundle\Form\Editor\NewsletterBlockArticleAssignmentEditorType;
use AppBundle\Form\Filter\NewsletterBlockArticleAssignmentFilterType;
use AppBundle\Manager\Entity\Common\NewsletterBlockArticleAssignmentManager;
use AppBundle\Manager\Filter\Common\NewsletterBlockArticleAssignmentFilterManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockArticleAssignmentController extends BaseEntityController {
	
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
	// Managers
	//---------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getEntityManager()
	 */
	protected function getEntityManager($doctrine, $paginator) {
		return new NewsletterBlockArticleAssignmentManager($doctrine, $paginator);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getFilterManager()
	 */
	protected function getFilterManager($doctrine) {
		return new NewsletterBlockArticleAssignmentFilterManager($doctrine);
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	protected function getDeleteRole() {
		return 'ROLE_EDITOR';
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
		return NewsletterBlockArticleAssignment::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return NewsletterBlockArticleAssignmentEditorType::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFilterFormType()
	 */
	 protected function getFilterFormType() {
		return NewsletterBlockArticleAssignmentFilterType::class;
	}
}