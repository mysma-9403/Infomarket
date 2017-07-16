<?php

namespace AppBundle\Controller\Admin\Assignments;

use AppBundle\Controller\Admin\Base\AssignmentController;
use AppBundle\Controller\Admin\Base\BaseEntityController;
use AppBundle\Entity\NewsletterGroup;
use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Filter\Admin\Assignments\NewsletterUserNewsletterGroupAssignmentFilter;
use AppBundle\Form\Editor\Assignments\NewsletterUserNewsletterGroupAssignmentEditorType;
use AppBundle\Form\Filter\Admin\Assignments\NewsletterUserNewsletterGroupAssignmentFilterType;
use AppBundle\Manager\Entity\Common\NewsletterUserNewsletterGroupAssignmentManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Repository\Admin\Main\NewsletterGroupRepository;
use AppBundle\Repository\Admin\Main\NewsletterUserRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Base\BaseType;

class NewsletterUserNewsletterGroupAssignmentController extends AssignmentController {
	
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
	
		/** @var NewsletterUserRepository $newsletterUserRepository */
		$newsletterUserRepository = $this->getDoctrine()->getRepository(NewsletterUser::class);
		$options[BaseType::getChoicesName('newsletterUser')] = $newsletterUserRepository->findFilterItems();
	
		/** @var NewsletterGroupRepository $newsletterGroupRepository */
		$newsletterGroupRepository = $this->getDoctrine()->getRepository(NewsletterGroup::class);
		$options[BaseType::getChoicesName('newsletterGroup')] = $newsletterGroupRepository->findFilterItems();
	
		return $options;
	}
	
	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
	
		/** @var NewsletterUserRepository $newsletterUserRepository */
		$newsletterUserRepository = $this->getDoctrine()->getRepository(NewsletterUser::class);
		$options[BaseType::getChoicesName('newsletterUser')] = $newsletterUserRepository->findFilterItems();
	
		/** @var NewsletterGroupRepository $newsletterGroupRepository */
		$newsletterGroupRepository = $this->getDoctrine()->getRepository(NewsletterGroup::class);
		$options[BaseType::getChoicesName('newsletterGroup')] = $newsletterGroupRepository->findFilterItems();
	
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
		return new NewsletterUserNewsletterGroupAssignmentManager($doctrine, $paginator);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getFilterManager()
	 */
	protected function getFilterManager($doctrine) {
		return new FilterManager(new NewsletterUserNewsletterGroupAssignmentFilter());
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
		return NewsletterUserNewsletterGroupAssignment::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return NewsletterUserNewsletterGroupAssignmentEditorType::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFilterFormType()
	 */
	 protected function getFilterFormType() {
		return NewsletterUserNewsletterGroupAssignmentFilterType::class;
	}
}