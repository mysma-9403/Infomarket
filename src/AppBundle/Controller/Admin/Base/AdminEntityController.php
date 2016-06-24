<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Controller\Base\BaseEntityController;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Lists\Base\BaseEntityList;
use AppBundle\Form\Filter\Base\FilterFormType;
use AppBundle\Form\Lists\Base\BaseEntityListType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Base\Audit;

abstract class AdminEntityController extends BaseEntityController {
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::indexActionInternal()
	 */
	protected function indexActionInternal(Request $request, $page)
	{
		$params = $this->getIndexParams($request, $page);
		
		$filter = $this->createNewFilter();
		$filter->initValues($request);
	
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
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getValues());
			}
				
			if ($form->get('selectNone')->isClicked()) {
				$filter->clearSelected();
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getValues());
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
		$entry = $this->createNewEntity($request);
		return $this->editEntry($request, $entry);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 */
	protected function copyActionInternal(Request $request, $id)
	{
		$entry = $this->getEntry($id);
		$entry = $this->createFromTemplate($request, $entry);
		return $this->editEntry($request, $entry);
	}
	
	protected function editActionInternal(Request $request, $id)
	{
		$entry = $this->getEntry($id);
		return $this->editEntry($request, $entry);
	}
	
	protected function deleteActionInternal(Request $request, $id)
	{
		$em = $this->getDoctrine()->getManager();
	
		//Make sure entity exists :)
		$entry = $this->getEntry($id);
		$em->remove($entry);
		$em->flush();
	
		$routingParams = $this->getRoutingParams($request);
		return $this->redirectToRoute($routingParams['route'], $routingParams['routeParams']);
	}
	
	protected function setPublishedActionInternal(Request $request, $id)
	{
		$published = $request->get('published', false);
		
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
		$featured = $request->get('featured', false);
	
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
		$em = $this->getDoctrine()->getManager();
	
		foreach ($entries as $entry)
			$em->remove($entry);
	
		$em->flush();
	}
	
	protected function setPublishedSelected($entries, $published)
	{
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
	protected function editEntry(Request $request, $entry)
	{
		$params = $this->getEditParams($request, $entry);
		$routingParams = $params['routingParams'];
		
		$form = $this->createForm($this->getFormType(), $entry);
	
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid())
		{
			$this->saveEntry($entry);
	
			$this->addFlash('success', 'info.entry.created_successfully'); //TODO label
	
			if ($form->get('saveAndNew')->isClicked()) {
				return $this->redirectToRoute($this->getNewRoute(), $params);
			}
	
			if ($form->get('saveAndCopy')->isClicked()) {
				$params['id'] = $entry->getId();
				return $this->redirectToRoute($this->getCopyRoute(), $params);
			}
			
			if ($form->get('saveAndQuit')->isClicked()) {
				$routingParams = $this->getRoutingParams($request);
				return $this->redirectToRoute($routingParams['route'], $routingParams['routeParams']);
			}
		}
		$params['entry'] = $entry;
		$params['form'] = $form->createView();
	
		return $this->render($this->getEditView(), $params);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getIndexRoutingParams()
	 */
	protected function getIndexRoutingParams(Request $request)
	{
		$params = array();
		 
		$routeParams = $request->get('routeParams', []);
		$routeParams['page'] = $request->get('page', null);
	
		//TODO filter and entryFilter are little different, getEntityFilter should be split into two stages:
		// 1. init from request -> use in route params
		// 2. init additional data like published = true -> in admin panel its not desireable!!
	
		$filter = $this->createNewFilter();
		$filter->initValues($request);
	
		$routeParams = array_merge($routeParams, $filter->getValues());
		 
		$params['routeParams'] = $routeParams;
		 
		return $params;
	}
	
	/**
	 *
	 * @param Request $request
	 * @param mixed $entry current entry
	 * @return mixed[]
	 */
	protected function getEditParams(Request $request, $entry)
	{
		$params = $this->getParams($request);
		
		$params['entry'] = $entry;
		 
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
	
	protected function getEntry($id) {
		$repository = $this->getDoctrine()->getRepository($this->getEntityType());
		$entry = $repository->find($id);
	
		return $entry;
	}
	
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
		return $this->createNewEntity($request);
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
	
	protected function createNewFilter() {
		return new BaseEntityFilter();
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
}