<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Controller\Admin\Base\SimpleEntityController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Form\Filter\UserFilterType;
use AppBundle\Entity\Filter\UserFilter;
use AppBundle\Form\Lists\UserListType;

class UserController extends SimpleEntityController
{
/**
	 * 
	 * @param Request $request
	 * @param unknown $page
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param unknown $id
	 */
	public function editAction(Request $request, $id)
	{
		return $this->editActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id)
	{
		return $this->deleteActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 */
	public function settingsAction(Request $request)
	{
		return $this->settingsActionInternal($request);
	}
	
	//------------------------------------------------------------------------
	// Internal logic
	//------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request
	 * @param unknown $entry
	 */
	protected function settingsActionInternal(Request $request)
	{
		$params = $this->getSettingsParams($request);
		
		$entry = $this->get('security.token_storage')->getToken()->getUser();
	
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
		
		$params['entry'] = $entry;
		$params['form'] = $form->createView();
	
		return $this->render($this->getSettingsView(), $params);
	}
	
	/**
	 * 
	 * @param Request $request
	 */
	protected function getSettingsParams(Request $request)
	{
		$params = $this->getParams($request);
	
		$routeParams = array();
		$this->registerRequest($request, $this->getEditRoute(), $routeParams);
			
		$params = array_merge($params, $this->getRoutingParams($request));
		return $params;
	}
	
	//------------------------------------------------------------------------
	// Entity creators
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::createNewEntity()
	 */
	protected function createNewEntity(Request $request) {
		return new User();
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::createFromTemplate()
	 */
	protected function createFromTemplate(Request $request, $template) {
		$entry = parent::createFromTemplate($request, $template);
	
		$entry->setEmail($template->getEmail());
		$entry->setForename($template->getForename());
		$entry->setSurname($template->getSurname());
	
		return $entry;
	}
	
	protected function createNewFilter() {
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		return new UserFilter($userRepository);
	}
	
	//------------------------------------------------------------------------
	// Entity types
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return User::class;
	}
	
	
	//------------------------------------------------------------------------
	// Form types
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFormType()
	 */
	protected function getFormType() {
		return UserType::class;
	}
	
	protected function getFilterFormType() {
		return UserFilterType::class;
	}
	
	protected function getListFormType() {
		return UserListType::class;
	}
	
	//------------------------------------------------------------------------
	// Helpers
	//------------------------------------------------------------------------
	
	protected function getSettingsRoute() {
		return $this->getIndexRoute() . '_settings';
	}
	
	protected function getSettingsView() {
		return $this->getBaseName() . '/' . $this->getEntityName() . '/settings.html.twig';
	}
}