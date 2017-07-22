<?php

namespace AppBundle\Controller\Admin\Assignments;

use AppBundle\Controller\Admin\Base\AssignmentController;
use AppBundle\Controller\Admin\Base\BaseEntityController;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;
use AppBundle\Factory\Common\Choices\Enum\NewsletterUserNewsletterPageAssignmentStatesFactory;
use AppBundle\Filter\Admin\Assignments\NewsletterUserNewsletterPageAssignmentFilter;
use AppBundle\Form\Base\BaseType;
use AppBundle\Form\Filter\Admin\Assignments\NewsletterUserNewsletterPageAssignmentFilterType;
use AppBundle\Manager\Entity\Common\NewsletterUserNewsletterPageAssignmentManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Repository\Admin\Main\NewsletterPageRepository;
use AppBundle\Repository\Admin\Main\NewsletterUserRepository;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserNewsletterPageAssignmentController extends AssignmentController {
	
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
		$options[BaseType::getChoicesName('newsletterUsers')] = $newsletterUserRepository->findFilterItems();
	
		/** @var NewsletterPageRepository $newsletterPageRepository */
		$newsletterPageRepository = $this->getDoctrine()->getRepository(NewsletterPage::class);
		$options[BaseType::getChoicesName('newsletterPages')] = $newsletterPageRepository->findFilterItems();
		
		/** @var NewsletterUserNewsletterPageAssignmentStatesFactory $statesFactory */
		$statesFactory = $this->get('app.factory.choices.newsletterUserNewsletterPageAssignment.states');
		$options[BaseType::getChoicesName('states')] = $statesFactory->getItems();
	
		return $options;
	}
	
	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
	
		/** @var NewsletterUserRepository $newsletterUserRepository */
		$newsletterUserRepository = $this->getDoctrine()->getRepository(NewsletterUser::class);
		$options[BaseType::getChoicesName('newsletterUser')] = $newsletterUserRepository->findFilterItems();
	
		/** @var NewsletterPageRepository $newsletterPageRepository */
		$newsletterPageRepository = $this->getDoctrine()->getRepository(NewsletterPage::class);
		$options[BaseType::getChoicesName('newsletterPage')] = $newsletterPageRepository->findFilterItems();
	
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
		return new NewsletterUserNewsletterPageAssignmentManager($doctrine, $paginator);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getFilterManager()
	 */
	protected function getFilterManager($doctrine) {
		return new FilterManager(new NewsletterUserNewsletterPageAssignmentFilter());
	}
	
	//---------------------------------------------------------------------------
	// Permissions
	//---------------------------------------------------------------------------
	protected function canCreate() {
		return false;
	}
	
	protected function canCopy() {
		return false;
	}
	
	protected function canEdit() {
		return false;
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	protected function getDeleteRole() {
		return 'ROLE_SUPER_ADMIN';
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
		return NewsletterUserNewsletterPageAssignment::class;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFilterFormType()
	 */
	protected function getEditorFormType() {
		return null; //TODO refactor Controller hierarchy
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFilterFormType()
	 */
	 protected function getFilterFormType() {
		return NewsletterUserNewsletterPageAssignmentFilterType::class;
	}
}