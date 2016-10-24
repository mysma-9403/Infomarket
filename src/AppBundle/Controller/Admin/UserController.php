<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\User;
use AppBundle\Form\Filter\UserFilterType;
use AppBundle\Form\Lists\UserListType;
use AppBundle\Form\UserType;
use AppBundle\Manager\Entity\Common\UserManager;
use AppBundle\Manager\Filter\Common\UserFilterManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Params\EntryParams\Admin\UserEntryParamsManager;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;

class UserController extends SimpleEntityController
{
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
	public function settingsAction(Request $request)
	{
		return $this->settingsActionInternal($request);
	}
	
	//------------------------------------------------------------------------
	// Internal actions
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * @param Request $request
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	protected function settingsActionInternal(Request $request)
	{
		$params = $this->createParams($this->getSettingsRoute());
		$params = $this->getSettingsParams($request, $params);
	
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$this->denyAccessUnlessGranted('edit', $entry);
	
		$form = $this->createForm($this->getFormType(), $entry);
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid())
		{
			$this->saveEntry($entry);
	
			$this->addFlash('success', 'success.created');
				
			if ($form->get('save')->isClicked()) {
				return $this->redirectToRoute($this->getSettingsRoute());
			}
		}
		
		$viewParams['form'] = $form->createView();
	
		return $this->render($this->getSettingsView(), $viewParams);
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$tokenStorage = $this->get('security.token_storage');
		return new UserEntryParamsManager($em, $fm, $doctrine, $tokenStorage);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return new UserManager($doctrine, $paginator);
	}
	
	protected function getFilterManager($doctrine) {
		return new UserFilterManager($doctrine);
	}
	
	//---------------------------------------------------------------------------
	// Params
	//---------------------------------------------------------------------------
	protected function getSettingsParams(Request $request, array $params) {
		$params = $this->getParams($request, $params);
	
		$em = $this->getEntryParamsManager();
		$params = $em->getSettingsParams($request, $params);
		
		return $params;
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
		return User::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFormType()
	 */
	protected function getFormType() {
		return UserType::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFilterFormType()
	 */
	protected function getFilterFormType() {
		return UserFilterType::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getListFormType()
	 */
	protected function getListFormType() {
		return UserListType::class;
	}
	
	//------------------------------------------------------------------------
	// Views
	//------------------------------------------------------------------------
	
	protected function getSettingsView() {
		return $this->getDomain() . '/' . $this->getEntityName() . '/settings.html.twig';
	}
	
	//------------------------------------------------------------------------
	// Routes
	//------------------------------------------------------------------------
	
	protected function getSettingsRoute() {
		return $this->getIndexRoute() . '_settings';
	}
	
	//---------------------------------------------------------------------------
	// Settings
	//---------------------------------------------------------------------------
	
	protected function getDeleteRole() {
		return 'ROLE_SUPER_ADMIN';
	}
}