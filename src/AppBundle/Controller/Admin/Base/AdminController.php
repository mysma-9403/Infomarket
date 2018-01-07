<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Controller\Base\StandardController;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\Base\BaseFilter;
use AppBundle\Manager\Decorator\Base\ItemDecorator;
use AppBundle\Manager\Params\Admin\ContextParamsManager;
use AppBundle\Manager\Persistence\Base\PersistenceManager;
use AppBundle\Manager\Route\RouteManager;
use AppBundle\Manager\Transaction\Base\TransactionManager;
use AppBundle\Misc\FormOptions\FormOptionsProvider;
use AppBundle\Misc\ListItemsProvider\ListItemsProvider;
use AppBundle\Validator\Base\BaseValidator;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

abstract class AdminController extends StandardController {

	/**
	 *
	 * @var TransactionManager
	 */
	protected $transactionManager;

	/**
	 *
	 * @var PersistenceManager
	 */
	protected $persistenceManager;

	/**
	 *
	 * @var ItemDecorator
	 */
	protected $decorator;

	/**
	 *
	 * @var BaseValidator
	 */
	protected $validator;

	public function __construct(TransactionManager $transactionManager, PersistenceManager $persistenceManager, 
			ItemDecorator $decorator, BaseValidator $validator) {
		$this->transactionManager = $transactionManager;
		$this->persistenceManager = $persistenceManager;
		$this->decorator = $decorator;
		$this->validator = $validator;
	}
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Controller\Base\StandardController::indexActionInternal()
	 */
	protected function indexActionInternal(Request $request, $page) {
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		return parent::indexActionInternal($request, $page);
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Controller\Base\StandardController::showActionInternal()
	 */
	protected function showActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		return parent::showActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 */
	protected function newActionInternal(Request $request) {
		$this->denyAccessUnlessGranted($this->getCreateRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getNewRoute());
		$params = $this->getNewParams($request, $params);
		
		$response = $this->initNewForms($request, $params);
		if ($response)
			return $response;
		
		$viewParams = $params['viewParams'];
		return $this->render($this->getEditView(), $viewParams);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param unknown $id        	
	 */
	protected function copyActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted($this->getCopyRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getCopyRoute());
		$params = $this->getCopyParams($request, $params, $id);
		
		$response = $this->initCopyForms($request, $params);
		if ($response)
			return $response;
		
		$viewParams = $params['viewParams'];
		return $this->render($this->getEditView(), $viewParams);
	}

	protected function editActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getEditRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		$am->sendEventAnalytics($this->getEntityName(), 'show', $id);
		
		$response = $this->initEditForms($request, $params);
		if ($response)
			return $response;
		
		$viewParams = $params['viewParams'];
		return $this->render($this->getEditView(), $viewParams);
	}

	protected function deleteActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted($this->getDeleteRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getDeleteRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$item = $viewParams['entry'];
		
		$errors = $this->validator->validateDeletedItem($item);
		if (count($errors) > 0) {
			foreach ($errors as $error) {
				$this->addFlash('error', $error->getMessage());
			}
			return $this->redirectToReferer($request);
		} else {
			$this->deleteItem($request, $item, $params);
		}
		
		/** @var RouteManager $rm */
		$rm = $this->getRouteManager();
		$rm->remove($request, $id);
		$lastRoute = $rm->getLastRoute($request, 
				['route' => $this->getIndexRoute(), 'routeParams' => array()]);
		
		return $this->redirectToRoute($lastRoute['route'], $lastRoute['routeParams']);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param BaseFormType $form        	
	 */
	protected function listFormActionInternal(Request $request, Form $form, BaseFilter $filter, array $listItems, 
			array $params) {
		if ($form->get('selectAll')->isClicked()) {
			foreach ($listItems as $item) {
				$filter->addSelected($item);
			}
		}
		
		if ($form->get('selectNone')->isClicked()) {
			$filter->clearSelected();
		}
		
		if ($form->get('deleteSelected')->isClicked()) {
			$data = $form->getData();
			$ids = $data->getEntries();
			$filter->clearSelected();
			$this->deleteSelected($request, $ids, $params);
		}
		
		return $this->redirectToRoute($this->getIndexRoute(), $filter->getRequestValues());
	}
	
	// ---------------------------------------------------------------------------
	// Actions blocks
	// ---------------------------------------------------------------------------
	protected function initIndexForms(Request $request, array &$params) {
		$response = parent::initIndexForms($request, $params);
		if ($response)
			return $response;
		
		$response = $this->initIndexFilterForm($request, $params);
		if ($response)
			return $response;
		
		$response = $this->initIndexListForm($request, $params);
		if ($response)
			return $response;
		
		return null;
	}

	protected function initIndexFilterForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$filter = $viewParams['entryFilter'];
		
		$optionsProvider = $this->getFilterFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$filterForm = $this->createForm($this->getFilterFormType(), $filter, $options);
		$filterForm->handleRequest($request);
		
		if ($filterForm->isSubmitted() && $filterForm->isValid()) {
			
			if ($filterForm->get('search')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getRequestValues());
			}
			
			if ($filterForm->get('clear')->isClicked()) {
				$filter->clearRequestValues();
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getRequestValues());
			}
		}
		
		$viewParams['filter'] = $filterForm->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}

	protected function initIndexListForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$filter = $viewParams['entryFilter'];
		
		$items = $viewParams['entries'];
		$selectedEntries = $this->getSelectedEntries($filter, $items);
		
		$listItemsProvider = $this->getListItemsProvider();
		$listItems = $listItemsProvider->getListItems($items);
		
		$viewParams['listItems'] = $listItems;
		$params['viewParams'] = $viewParams;
		
		$optionsProvider = $this->getListFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm($this->getListFormType(), $selectedEntries, $options);
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			return $this->listFormActionInternal($request, $form, $filter, $listItems, $params);
		}
		
		$viewParams['form'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}

	protected function initNewForms(Request $request, array &$params) {
		return $this->initUpdateForms($request, $params);
	}

	protected function initCopyForms(Request $request, array &$params) {
		return $this->initUpdateForms($request, $params);
	}

	protected function initEditForms(Request $request, array &$params) {
		return $this->initUpdateForms($request, $params);
	}

	protected function initUpdateForms(Request $request, array &$params) {
		$response = $this->initForms($request, $params);
		if ($response)
			return $response;
		
		$response = $this->initUpdateForm($request, $params);
		if ($response)
			return $response;
		
		return null;
	}

	protected function initUpdateForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$item = $viewParams['entry'];
		
		$optionsProvider = $this->getEditorFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm($this->getEditorFormType(), $item, $options);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$item = $this->getPreparedItem($request, $item, $params);
			$result = $this->saveItem($request, $item, $params);
			if ($result) {
				return $result;
			}
			
			$this->flashCreatedMessage();
			
			if ($form->get('save')->isClicked()) {
				return $this->redirectToRoute($this->getEditRoute(), array('id' => $item->getId()));
			}
		}
		
		$viewParams['form'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}
	
	// ---------------------------------------------------------------------------
	// Params
	// ---------------------------------------------------------------------------
	protected function getParams(Request $request, array $params) {
		$params = parent::getParams($request, $params);
		
		$cpm = $this->getContextParamsManager($request);
		$params = $cpm->getParams($request, $params);
		
		$viewParams = $params['viewParams'];
		
		$viewParams['canSelect'] = $this->canSelect();
		$viewParams['canEdit'] = $this->canEdit();
		$viewParams['canCreate'] = $this->canCreate();
		$viewParams['canCopy'] = $this->canCopy();
		$viewParams['canDelete'] = $this->canDelete();
		$viewParams['isAdmin'] = $this->isAdmin();
		
		$params['viewParams'] = $viewParams;
		
		return $params;
	}

	protected function getNewParams(Request $request, array $params) {
		$params = $this->getParams($request, $params);
		
		$em = $this->getEntryParamsManager();
		$params = $em->getNewParams($request, $params);
		
		return $params;
	}

	protected function getCopyParams(Request $request, array $params, $id) {
		$params = $this->getParams($request, $params);
		
		$em = $this->getEntryParamsManager();
		$params = $em->getCopyParams($request, $params, $id);
		
		return $params;
	}

	protected function getEditParams(Request $request, array $params, $id) {
		$params = $this->getParams($request, $params);
		
		$em = $this->getEntryParamsManager();
		$params = $em->getEditParams($request, $params, $id);
		
		return $params;
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getContextParamsManager(Request $request) {
		$doctrine = $this->getDoctrine();
		
		$rm = new RouteManager();
		$lastRoute = $rm->getLastRoute($request, $this->getHomeRoute());
		$lastRouteParams = $lastRoute['routeParams'];
		
		if (! $lastRouteParams) {
			$lastRouteParams = array();
		}
		
		return $this->getInternalContextParamsManager($doctrine, $lastRouteParams);
	}

	protected function getInternalContextParamsManager($doctrine, $lastRouteParams) {
		return new ContextParamsManager($doctrine, $lastRouteParams);
	}
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	/**
	 *
	 * @return FormOptionsProvider
	 */
	protected abstract function getListFormOptionsProvider();

	/**
	 *
	 * @return FormOptionsProvider
	 */
	protected abstract function getFilterFormOptionsProvider();

	/**
	 *
	 * @return FormOptionsProvider
	 */
	protected abstract function getEditorFormOptionsProvider();
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	/**
	 *
	 * @return ListItemsProvider
	 */
	protected abstract function getListItemsProvider();

	/**
	 * Get entries selected by the list checkboxes.
	 *
	 * @param SimpleFilter $filter        	
	 * @param array $allEntries        	
	 *
	 * @return BaseList
	 */
	protected function getSelectedEntries($filter, $listItems) {
		$result = $this->createNewList();
		
		foreach ($listItems as $item) {
			if (in_array($item['id'], $filter->getSelected())) {
				$result->addEntry($item['id']);
			}
		}
		
		return $result;
	}

	protected function deleteSelected(Request $request, array $ids, array $params) {
		$errors = [];
		
		$items = $this->getItemsByIds($ids);
		$errors = $this->validator->validateDeletedItems($items);
		
		if (count($errors) > 0) {
			foreach ($errors as $error) {
				$this->addFlash('error', $error->getMessage());
			}
		} else if (count($items) > 0) {
			$this->deleteItems($request, $items, $params);
		}
	}

	protected function saveItem(Request $request, $item, array $params) {
		try {
			$this->transactionManager->saveItem($request, $item, $params);
		} catch (Exception $ex) {
			$this->addFlash('error', $ex->getMessage());
			return $this->redirectToReferer($request);
		}
	}

	protected function deleteItem(Request $request, $item, array $params) {
		try {
			$this->transactionManager->deleteItem($request, $item, $params);
		} catch (Exception $ex) {
			$this->addFlash('error', $ex->getMessage());
			return $this->redirectToReferer($request);
		}
	}

	protected function deleteItems(Request $request, array $items, array $params) {
		try {
			$this->transactionManager->deleteItems($request, $items, $params);
		} catch (Exception $ex) {
			$this->addFlash('error', $ex->getMessage());
			return $this->redirectToReferer($request);
		}
	}

	protected function getPreparedItem(Request $request, $item, array $params) {
		return $this->decorator->getPrepared($item);
	}

	/**
	 *
	 * @param array $items        	
	 * @param boolean $published        	
	 */
	protected function setValueForSelected($items, $field, $published) {
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
		
		if (count($items) > 0) {
			/** @var BaseRepository $repository */
			$repository = $this->getEntityRepository();
			$repository->setValue($items, $field, $published);
		}
	}

	protected function getItemsByIds(array $ids) {
		/** @var BaseRepository $repository */
		$repository = $this->getEntityRepository();
		return $repository->findBy(['id' => $ids]);
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	
	/**
	 */
	abstract protected function createNewList();

	/**
	 */
	abstract protected function getEditorFormType();

	/**
	 */
	abstract protected function getFilterFormType();

	/**
	 */
	abstract protected function getListFormType();
	
	// ---------------------------------------------------------------------------
	// Permissions
	// ---------------------------------------------------------------------------
	protected function canSelect() {
		return $this->isGranted($this->getEditRole());
	}

	protected function canEdit() {
		return $this->isGranted($this->getEditRole());
	}

	protected function canCreate() {
		return $this->canEdit() && $this->isGranted($this->getCreateRole());
	}

	protected function canCopy() {
		return $this->canCreate() && $this->isGranted($this->getCopyRole());
	}

	protected function canDelete() {
		return $this->canEdit() && $this->isGranted($this->getDeleteRole());
	}

	protected function isAdmin() {
		return $this->isGranted($this->getAdminRole());
	}
	
	// ---------------------------------------------------------------------------
	// Roles
	// ---------------------------------------------------------------------------
	protected function getShowRole() {
		return 'ROLE_USER';
	}

	protected function getEditRole() {
		return 'ROLE_EDITOR';
	}

	protected function getCreateRole() {
		return $this->getEditRole();
	}

	protected function getCopyRole() {
		return $this->getCreateRole();
	}

	protected function getDeleteRole() {
		return 'ROLE_ADMIN';
	}

	protected function getAdminRole() {
		return 'ROLE_ADMIN';
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getNewRoute() {
		return $this->getIndexRoute() . '_new';
	}

	protected function getCopyRoute() {
		return $this->getIndexRoute() . '_copy';
	}

	protected function getEditRoute() {
		return $this->getIndexRoute() . '_edit';
	}

	protected function getDeleteRoute() {
		return $this->getIndexRoute() . '_delete';
	}

	protected function getHomeRoute() {
		return array('route' => $this->getIndexView(), 'routeParams' => array());
	}
	
	// ---------------------------------------------------------------------------
	// Views
	// ---------------------------------------------------------------------------
	protected function getEditView() {
		return $this->getDomain() . '/' . $this->getEntityName() . '/editor.html.twig';
	}
	
	// ---------------------------------------------------------------------------
	// Domain
	// ---------------------------------------------------------------------------
	protected function getDomain() {
		return 'admin';
	}
}