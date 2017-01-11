<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Controller\Base\StandardController;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Lists\Base\BaseEntityList;
use AppBundle\Manager\Route\RouteManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

abstract class AdminController extends StandardController {
	
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::indexActionInternal()
	 */
	protected function indexActionInternal(Request $request, $page)
	{
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		
		$viewParams = $params['viewParams'];
		
		
		
		
		$filter = $viewParams['entryFilter'];
	
		$filterForm = $this->createForm($this->getFilterFormType(), $filter);
		$filterForm->handleRequest($request);
	
		if ($filterForm->isSubmitted() && $filterForm->isValid()) {
			
			if ($filterForm->get('search')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getValues());
			}
			
			if ($filterForm->get('clear')->isClicked()) {
				$filter->clearQueryValues();
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getValues());
			}
		}
		$viewParams['filter'] = $filterForm->createView();
		
		
		
		
		$allEntries = $viewParams['entries'];
		$selectedEntries = $this->getSelectedEntries($filter, $allEntries);
		
		$form = $this->createForm($this->getListFormType(), $selectedEntries, array('choices' => $allEntries));
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid())
		{
			return $this->listFormActionInternal($request, $form, $filter, $allEntries);
		}
		$viewParams['form'] = $form->createView();
		
		
		
		return $this->render($this->getIndexView(), $viewParams);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param Form $form
	 * @param BaseEntityFilter $filter
	 * @param unknown $allEntries
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\AppBundle\Controller\Base\RedirectResponse
	 */
	protected function listFormActionInternal(Request $request, Form $form, BaseEntityFilter $filter, $allEntries) {
		if ($form->get('new')->isClicked()) {
			return $this->redirectToRoute($this->getNewRoute());
		}
		
		if ($form->get('selectAll')->isClicked()) {
			foreach ($allEntries as $entry) {
				$filter->addSelected($entry->getId());
			}
		}
		
		if ($form->get('selectNone')->isClicked()) {
			$filter->clearSelected();
		}
		
		if ($form->get('deleteSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$this->deleteSelected($entries);
		
			return $this->redirectToReferer($request);
		}
		
		return $this->redirectToRoute($this->getIndexRoute(), $filter->getValues());
	}
	
	protected function showActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		
		return parent::showActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 */
	protected function newActionInternal(Request $request)
	{
		$this->denyAccessUnlessGranted($this->getNewRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getNewRoute());
		$params = $this->getNewParams($request, $params);
		
		return $this->editEntry($request, $params);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param unknown $id
	 */
	protected function copyActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getCopyRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getCopyRoute());
		$params = $this->getCopyParams($request, $params, $id);
		
		return $this->editEntry($request, $params);
	}
	
	protected function editActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getEditRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		$am->sendEventAnalytics($this->getEntityName(), 'show', $id);
		
		return $this->editEntry($request, $params);
	}
	
	protected function deleteActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getDeleteRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getDeleteRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
	
		//TODO ValidationManager??
		$validator = $this->get('validator');
		$errors = $validator->validate($entry, null, array('removal'));
	
		if (count($errors) > 0) {
			foreach ($errors as $error) {
				$this->addFlash('error', $error->getMessage());
			}
			return $this->redirectToReferer($request);
		} else {
			$em = $this->getDoctrine()->getManager();
			$em->getConnection()->beginTransaction();
				
			try {
				$errors = $this->deleteMore($entry);
				if (count($errors) > 0) {
					foreach ($errors as $error) {
						$this->addFlash('error', $error->getMessage());
					}
						
					$em->getConnection()->rollback();
					return $this->redirectToReferer($request);
				}
				else {
					$em->remove($entry);
					$em->flush();
						
					$em->getConnection()->commit();
				}
			} catch (Exception $ex) {
				$em->getConnection()->rollback();
				$this->addFlash('error', $ex->getMessage());
				return $this->redirectToReferer($request);
			}
		}
		
		/** @var RouteManager $rm */
		$rm = $this->getRouteManager();
		$rm->remove($request, $id);
		$lastRoute = $rm->getLastRoute($request, ['route' => $this->getIndexRoute(), 'routeParams' => array()]);
		return $this->redirectToRoute($lastRoute['route'], $lastRoute['routeParams']);
	}
	
	//---------------------------------------------------------------------------
	// Params
	//---------------------------------------------------------------------------
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
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	/**
	 * Get entries selected by the list checkboxes.
	 *
	 * @param SimpleEntityFilter $filter
	 * @param array $allEntries
	 *
	 * @return BaseEntityList
	 */
	protected function getSelectedEntries($filter, $allEntries) {
		$result = $this->createNewList();
	
		foreach ($allEntries as $entry) {
			if(in_array($entry->getId(), $filter->getSelected())) {
				$result->addEntry($entry);
			}
		}
		return $result;
	}
	
	/**
	 * 
	 * @param unknown $entries
	 */
	protected function deleteSelected($entries)
	{
		$this->denyAccessUnlessGranted($this->getDeleteRole(), null, 'Unable to access this page!');
	
		$em = $this->getDoctrine()->getManager();
		
		$validator = $this->get('validator');
	
		foreach ($entries as $entry) {
			$entryErrors = $validator->validate($entry, null, array('removal'));
			
			if (count($entryErrors) > 0) {
				foreach ($entryErrors as $error) {
					$this->addFlash('error', $error->getMessage());
				}
			}
			else {
				$errors = $this->deleteMore($entry);
				if (count($errors) > 0) {
					foreach ($errors as $error) {
						$this->addFlash('error', $error->getMessage());
					}
				} else {
					$em->remove($entry);
				}
			}
		}
		
		$em->flush();
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $entry
	 */
	protected function editEntry(Request $request, $params)
	{	
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$form = $this->createForm($this->getEditorFormType(), $entry);
	
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid())
		{
			$this->saveEntry($entry);
	
			$this->addFlash('success', 'success.created');
			
			if ($form->get('save')->isClicked()) {
				return $this->redirectToRoute($this->getEditRoute(), array('id' => $entry->getId()));
			}
		}
		
		$viewParams['form'] = $form->createView();
	
		return $this->render($this->getEditView(), $viewParams);
	}
	
	/**
	 * 
	 * @param unknown $entry
	 */
	protected function saveEntry($entry) {
		$em = $this->getDoctrine()->getManager();
	
		$this->prepareEntry($entry);
			
		$em->persist($entry);
		$em->flush();
	}
	
	/**
	 * 
	 * @param unknown $entry
	 */
	protected function prepareEntry($entry) { }
	
	protected function getRepository() {
		return $this->getDoctrine()->getRepository($this->getEntityType());
	}
	
	protected function deleteMore($entry)
	{
		return array();
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	/**
	 * 
	 */
	abstract protected function createNewList();
	
	/**
	 *
	 */
	abstract protected function getEditorFormType();
	
	/**
	 *
	 */
	abstract protected function getFilterFormType();
	
	/**
	 *
	 */
	abstract protected function getListFormType();
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	
	protected function getShowRole() {
		return 'ROLE_EDITOR';
	}
	
	protected function getEditRole() {
		return 'ROLE_EDITOR';
	}
	
	protected function getNewRole() {
		return $this->getEditRole();
	}
	
	protected function getCopyRole() {
		return $this->getNewRole();
	}
	
	protected function getDeleteRole() {
		return 'ROLE_ADMIN';
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	protected function getNewRoute()
	{
		return $this->getIndexRoute() . '_new';
	}
	
	protected function getCopyRoute()
	{
		return $this->getIndexRoute() . '_copy';
	}
	
	protected function getEditRoute()
	{
		return $this->getIndexRoute() . '_edit';
	}
	
	protected function getDeleteRoute()
	{
		return $this->getIndexRoute() . '_delete';
	}
	
	//---------------------------------------------------------------------------
	// Views
	//---------------------------------------------------------------------------
	
	protected function getEditView()
	{
		return $this->getDomain() . '/' . $this->getEntityName() . '/editor.html.twig';
	}
	
	//---------------------------------------------------------------------------
	// Domain
	//---------------------------------------------------------------------------
	
	protected function getDomain() {
		return 'admin';
	}
}