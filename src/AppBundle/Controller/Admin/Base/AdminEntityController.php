<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Controller\Base\BaseEntityController;
use AppBundle\Entity\Base\Audit;
use AppBundle\Entity\Lists\Base\BaseEntityList;
use AppBundle\Form\Filter\Base\FilterFormType;
use AppBundle\Form\Lists\Base\BaseEntityListType;
use Symfony\Component\HttpFoundation\Request;

abstract class AdminEntityController extends BaseEntityController {
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::indexActionInternal()
	 */
	protected function indexActionInternal(Request $request, $page)
	{
		$params = $this->getIndexParams($request, $page);
		
		$filter = $this->getEntityFilter($request);
	
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
		$params['filter'] = $filterForm->createView();
	
		
		
		
		$allEntries = $this->getAllEntries($filter, $page);
		$selectedEntries = $this->getSelectedEntries($filter, $allEntries);
	
		$form = $this->createForm($this->getListFormType(), $selectedEntries, array('choices' => $allEntries));
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid())
		{	
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
			}
				
			if ($form->get('publishSelected')->isClicked()) {
				$data = $form->getData();
				$entries = $data->getEntries();
				$this->setPublishedSelected($entries, true);
			}
				
			if ($form->get('unpublishSelected')->isClicked()) {
				$data = $form->getData();
				$entries = $data->getEntries();
				$this->setPublishedSelected($entries, false);
			}
			
			return $this->redirectToRoute($this->getIndexRoute(), $filter->getValues());
		}
		$params['entries'] = $allEntries;
		$params['form'] = $form->createView();
			
		return $this->render($this->getIndexView(), $params);
	}
	
	/**
	 * Get all entries matching criteria specified in $filter.
	 *
	 * @param SimpleEntityFilter $filter
	 * @param int $page
	 *
	 * @return array
	 */
	protected function getAllEntries($filter, $page) {
		$repository = $this->getRepository();
		$query = $repository->querySelected($filter);
			
		$paginator = $this->get('knp_paginator');
		return $paginator->paginate($query, $page, 8); //TODO count settings?
	}
	
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
	 * @param Request $request
	 */
	protected function newActionInternal(Request $request)
	{
		$this->denyAccessUnlessGranted('ROLE_EDITOR', null, 'Unable to access this page!');
		
		$params = $this->getNewParams($request);
		return $this->editEntry($request, $params);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 */
	protected function copyActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted('ROLE_EDITOR', null, 'Unable to access this page!');
		
		$params = $this->getCopyParams($request, $id);
		return $this->editEntry($request, $params);
	}
	
	protected function editActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted('ROLE_EDITOR', null, 'Unable to access this page!');
		
		$params = $this->getEditParams($request, $id);
		return $this->editEntry($request, $params);
	}
	
	protected function deleteActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getDeleteRole(), null, 'Unable to access this page!');
		
		$entry = $this->getEntry($id);
		
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
		
		$routingParams = $this->getRoutingParams($request);
		return $this->redirectToRoute($routingParams['route'], $routingParams['routeParams']);
	}
	
	protected function deleteMore($entry) 
	{
		return array();
	}
	
	protected function setPublishedActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted('ROLE_EDITOR', null, 'Unable to access this page!');
		
		$published = $request->get('value', false);
		
		$em = $this->getDoctrine()->getManager();
	
		//Make sure entity exists :)
		$entry = $this->getEntry($id);
		$entry->setPublished($published);
		$em->persist($entry);
		$em->flush();
	
		$routingParams = $this->getRoutingParams($request);
		return $this->redirectToRoute($routingParams['route'], $routingParams['routeParams']);
	}
	
	protected function setFeaturedActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted('ROLE_EDITOR', null, 'Unable to access this page!');
		
		$featured = $request->get('value', false);
	
		$em = $this->getDoctrine()->getManager();
	
		//Make sure entity exists :)
		$entry = $this->getEntry($id);
		$entry->setFeatured($featured);
		$em->persist($entry);
		$em->flush();
	
		$routingParams = $this->getRoutingParams($request);
		return $this->redirectToRoute($routingParams['route'], $routingParams['routeParams']);
	}
	
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
	
	protected function setPublishedSelected($entries, $published)
	{
		$this->denyAccessUnlessGranted('ROLE_EDITOR', null, 'Unable to access this page!');
		
		$em = $this->getDoctrine()->getManager();
	
		foreach ($entries as $entry) {
			$entry->setPublished($published);
			$em->persist($entry);
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
		$entry = $params['entry'];
		
		$this->denyAccessUnlessGranted('edit', $entry);
		
		$form = $this->createForm($this->getFormType(), $entry);
	
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid())
		{
			$this->saveEntry($entry);
	
			$this->addFlash('success', 'success.created');
			
			if ($form->get('save')->isClicked()) {
				return $this->redirectToRoute($this->getEditRoute(), array('id' => $entry->getId()));
			}
		}
		
		$params['form'] = $form->createView();
	
		return $this->render($this->getEditView(), $params);
	}
	
	protected function getNewParams(Request $request)
	{
		$params = $this->getParams($request);
	
		$routeParams = array();
		$this->registerRequest($request, $this->getNewRoute(), $routeParams);
	
		$entry = $this->createNewEntity($request);
		$params['entry'] = $entry;
			
		$params = array_merge($params, $this->getRoutingParams($request));
		return $params;
	}
	
	protected function getCopyParams(Request $request, $id)
	{
		$params = $this->getParams($request);
	
		$routeParams = array();
		$this->registerRequest($request, $this->getCopyRoute(), $routeParams);
		
		$template = $this->getEntry($id);
		$entry = $this->createFromTemplate($request, $template);
		$params['entry'] = $entry;
			
		$params = array_merge($params, $this->getRoutingParams($request));
		return $params;
	}
	
	/**
	 *
	 * @param Request $request
	 * @param mixed $entry current entry
	 * @return mixed[]
	 */
	protected function getEditParams(Request $request, $id)
	{
		$params = $this->getParams($request);
		
		$routeParams = array('id' => $id);
		$this->registerRequest($request, $this->getEditRoute(), $routeParams);
		
		$entry = $this->getEntry($id);
		$params['entry'] = $entry;
		 
		$params = array_merge($params, $this->getRoutingParams($request));
		return $params;
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
	
	
	protected function getEditView()
	{
		return $this->getBaseName() . '/' . $this->getEntityName() . '/editor.html.twig';
	}
	
	protected function getNewRoute()
	{
		return $this->getIndexRoute() . '_new';
	}
	
	protected function getEditRoute()
	{
		return $this->getIndexRoute() . '_edit';
	}
	
	protected function getCopyRoute()
	{
		return $this->getIndexRoute() . '_copy';
	}
	
	
	/**
	 * Create new entry as a copy of a $template
	 *
	 * @param mixed $template
	 *
	 * @return mixed
	 */
	protected function createFromTemplate(Request $request, $template) {
		$entity = $this->createNewEntity($request);
		
		$entity->setPublished($template->getPublished());
		
		return $entity;
	}
	
	/**
	 *
	 * @param Request $request
	 *
	 * @return mixed
	 */
	protected function createNewEntity(Request $request) {
		return new Audit();
	}
	
	protected function createNewList() {
		return new BaseEntityList();
	}
	
	
	/**
	 * Get entity list class (e.g. BundleListType::class)
	 *
	 * @return mixed
	 */
	protected function getListFormType() {
		return BaseEntityListType::class;
	}
	
	/**
	 * Get entity filter class (e.g <strong>SimpleEntityFilterType::class</strong>)
	 *
	 * @return mixed
	 */
	protected function getFilterFormType() {
		return FilterFormType::class;
	}
	
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getBaseName()
	 */
	protected function getBaseName() {
		return 'admin';
	}
	
	protected function getDeleteRole() {
		return 'ROLE_EDITOR';
	}
}