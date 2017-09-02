<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\AdminController;
use AppBundle\Entity\Lists\Base\BaseEntityList;
use AppBundle\Entity\User;
use AppBundle\Factory\Common\Choices\Enum\UserRolesFactory;
use AppBundle\Filter\Common\Main\UserFilter;
use AppBundle\Form\Editor\Admin\Main\UserEditorType;
use AppBundle\Form\Filter\Admin\Main\UserFilterType;
use AppBundle\Form\Lists\Base\BaseEntityListType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Admin\UserEntryParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Entity\Common\Main\UserManager;

class UserController extends AdminController
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
	
		$form = $this->createForm($this->getEditorFormType(), $entry, $this->getEditorFormOptions());
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
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getListItemKeyFields($item) {
		$fields = parent::getListItemKeyFields($item);
		
		$fields[] = $item['surname'];
		$fields[] = $item['forename'];
		
		return $fields;
	}
	
	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
		
		$this->addFactoryChoicesFormOption($options, UserRolesFactory::class, 'roles');
		
		return $options;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$tokenStorage = $this->get('security.token_storage');
		return new UserEntryParamsManager($em, $fm, $tokenStorage);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(UserManager::class);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new UserFilter());
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
	
	//---------------------------------------------------------------------------
	// Permissions
	//---------------------------------------------------------------------------
	protected function canCreate() {
		return false;
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	
	protected function getShowRole() {
		return 'ROLE_ADMIN';
	}
	
	protected function getEditRole() {
		return 'ROLE_ADMIN';
	}
	
	protected function getDeleteRole() {
		return 'ROLE_SUPER_ADMIN';
	}
	
	//------------------------------------------------------------------------
	// EntityType related
	//------------------------------------------------------------------------
	
	protected function createNewList() {
		return new BaseEntityList();
	}
	
	protected function getEntityType() {
		return User::class;
	}
	
	//------------------------------------------------------------------------
	// Forms
	//------------------------------------------------------------------------
	
	protected function getEditorFormType() {
		return UserEditorType::class;
	}
	
	protected function getFilterFormType() {
		return UserFilterType::class;
	}
	
	protected function getListFormType() {
		return BaseEntityListType::class; 
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
}