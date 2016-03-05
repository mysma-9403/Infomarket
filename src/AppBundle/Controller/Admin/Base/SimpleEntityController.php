<?php

namespace AppBundle\Controller\Admin\Base;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Base\SimpleEntity;
use AppBundle\Entity\Lists\Base\SimpleEntityList;
use AppBundle\Form\Base\SimpleEntityType;
use AppBundle\Form\Lists\Base\SimpleEntityListType;
use AppBundle\Utils\ClassUtils;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;

abstract class SimpleEntityController extends Controller
{
	public function indexAction(Request $request, $page)
	{
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
				$this->publishSelected($entries);
			}
			
			if ($form->get('unpublishSelected')->isClicked()) {
				$data = $form->getData();
				$entries = $data->getEntries();
				$this->unpublishSelected($entries);
			}
			 
			return $this->redirectToRoute($this->getIndexRoute(), $filter->getValues());
		}
		 
		return $this->render($this->getTwigList(), array(
				'entries' => $allEntries,
				'filter' => $filterForm->createView(),
				'form' => $form->createView()
		));
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
	 * @return SimpleEntityList
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
	 * Get repository for $this entity
	 *
	 * @return SimpleEntityRepository
	 */
	protected function getRepository() {
		return $this->getDoctrine()->getRepository($this->getEntityType());
	}
	
	public function showAction(Request $request, $id)
	{
		$entry = $this->getEntry($id);
		return $this->render($this->getTwigShow(), array('entry' => $entry));
	}
	
	public function newAction(Request $request) 
	{
		$entry = $this->createNewEntity($request);
		return $this->editEntry($request, $entry);
	}
	
	public function copyAction(Request $request, $id)
	{
		$entry = $this->getEntry($id);
		$entry = $this->createFromTemplate($request, $entry);
		return $this->editEntry($request, $entry);
	}
	
	/**
	 * Create new entry as a copy of a $template
	 *
	 * @param mixed $template
	 *
	 * @return mixed
	 */
	protected function createFromTemplate(Request $request, $template) {
		$entry = $this->createNewEntity($request);
		$entry->setName($template->getName());
		
		return $entry;
	}
	
	public function editAction(Request $request, $id)
	{
		$entry = $this->getEntry($id);
		return $this->editEntry($request, $entry);
	}
	
	public function editEntry(Request $request, $entry)
	{
		$form = $this->createForm($this->getFormType(), $entry);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid())
		{	
			$this->saveEntry($entry);
				
			$this->addFlash('success', 'info.entry.created_successfully'); //TODO label
		
			if ($form->get('saveAndNew')->isClicked()) {
				return $this->redirectToRoute($this->getNewRoute());
			}
		
			if ($form->get('saveAndCopy')->isClicked()) {
				return $this->redirectToRoute($this->getCopyRoute(), array('id' => $entry->getId()));
			}
		
			return $this->redirectToRoute($this->getIndexRoute());
		}
		
		return $this->render($this->getTwigEditor(), array('form' => $form->createView(), 'entry' => $entry));
	}
	
	protected function saveEntry($entry) {
		$em = $this->getDoctrine()->getManager();
		
		$this->prepareEntry($entry);
			
		$em->persist($entry);
		$em->flush();
	}
	
	protected function prepareEntry($entry) {}
	
	protected function getEntry($id) {
		$repository = $this->getDoctrine()->getRepository($this->getEntityType());
		$entry = $repository->find($id);
		
		if (!$entry) {
			throw $this->createNotFoundException('No entry found for id '.$id);
		}
		
		return $entry;
	}
	
	public function deleteAction(Request $request, $id)
	{
		$em = $this->getDoctrine()->getManager();
		
		//Make sure entity exists :)
		$entry = $this->getEntry($id);
		$em->remove($entry);
		$em->flush();
	
		return $this->redirectToRoute($this->getIndexRoute());
	}
	
	public function publishAction(Request $request, $id)
	{
		$em = $this->getDoctrine()->getManager();
	
		//Make sure entity exists :)
		$entry = $this->getEntry($id);
		$entry->setPublished(true);
		$em->persist($entry);
		$em->flush();
	
		return $this->redirectToRoute($this->getIndexRoute());
	}
	
	public function unpublishAction(Request $request, $id)
	{
		$em = $this->getDoctrine()->getManager();
	
		//Make sure entity exists :)
		$entry = $this->getEntry($id);
		$entry->setPublished(false);
		$em->persist($entry);
		$em->flush();
	
		return $this->redirectToRoute($this->getIndexRoute());
	}
	
	public function deleteSelected($entries)
	{
		$em = $this->getDoctrine()->getManager();
		
		foreach ($entries as $entry)
			$em->remove($entry);
		
		$em->flush();
	}
	
	public function publishSelected($entries)
	{
		$em = $this->getDoctrine()->getManager();
	
		foreach ($entries as $entry) {
			$entry->setPublished(true);
			$em->persist($entry);
		}
	
		$em->flush();
	}
	
	public function unpublishSelected($entries)
	{
		$em = $this->getDoctrine()->getManager();
	
		foreach ($entries as $entry) {
			$entry->setPublished(false);
			$em->persist($entry);
		}
	
		$em->flush();
	}
	
	
	//------------------------------------------------------------------------
	// Entity creators
	//------------------------------------------------------------------------
	
	/**
	 * Create new entry (e.g. new Branch())
	 *
	 * @return mixed
	 */
	protected function createNewEntity(Request $request) {
		return new SimpleEntity();
	}
	
	/**
	 * Create new filter (e.g <strong>new SimpleEntityFilter()</strong>)
	 *
	 * @return mixed
	 */
	protected function createNewFilter() {
		return new SimpleEntityFilter();
	}
	
	/**
	 * Create new list (e.g. new BranchList())
	 *
	 * @return mixed
	 */
	protected function createNewList() {
		return new SimpleEntityList();
	}
	
	
	//------------------------------------------------------------------------
	// Entity types
	//------------------------------------------------------------------------
	
	/**
	 * Get entity type (e.g. 'AppBundle:Branch')
	 *
	 * @return string
	 */
	protected abstract function getEntityType();
	
	/**
	 * Get entity list class (e.g. BundleList::class)
	 *
	 * @return mixed
	 */
	protected function getEntityListType() {
		return SimpleEntityListType::class;
	}
	
	
	//------------------------------------------------------------------------
	// Form types
	//------------------------------------------------------------------------
	
	/**
	 * Get form class (e.g. BundleType::class)
	 *
	 * @return mixed
	 */
	protected function getFormType() {
		return SimpleEntityType::class;
	}
	
	/**
	 * Get entity list class (e.g. BundleListType::class)
	 *
	 * @return mixed
	 */
	protected function getListFormType() {
		return SimpleEntityListType::class;
	}
	
	/**
	 * Get entity filter class (e.g <strong>SimpleEntityFilterType::class</strong>)
	 *
	 * @return mixed
	 */
	protected function getFilterFormType() {
		return SimpleEntityFilterType::class;
	}
	
	
	//------------------------------------------------------------------------
	// Twig templates
	//------------------------------------------------------------------------
	
	/**
	 * Get twig list path (e.g. admin/branch/list.html.twig)
	 *
	 * @return string
	 */
	protected function getTwigList() {
		return $this->getTwigBase() . $this->getTwigName() . '/list.html.twig';
	}
	
	/**
	 * Get twig editor path (e.g. admin/branch/editor.html.twig)
	 *
	 * @return string
	 */
	protected function getTwigEditor() {
		return $this->getTwigBase() . $this->getTwigName() . '/editor.html.twig';
	}
	
	/**
	 * Get twig show path (e.g. admin/branch/show.html.twig)
	 *
	 * @return string
	 */
	protected function getTwigShow() {
		return $this->getTwigBase() . $this->getTwigName() . '/show.html.twig';
	}
	
	/**
	 * Get twig name (e.g <strong>branches</strong>)
	 *
	 * @return string
	 */
	protected function getTwigName() {
		return ClassUtils::getClassName($this->getEntityType());
	}
	
	/**
	 * Get twig base (e.g <strong>admin/</strong>)
	 *
	 * @return string
	 */
	protected function getTwigBase() {
		return 'admin/';
	}
	
	
	
	//------------------------------------------------------------------------
	// Routing
	//------------------------------------------------------------------------
	
	/**
	 * Get new route (e.g. admin_branches_new)
	 *
	 * @return string
	 */
	protected function getNewRoute() {
		return $this->getIndexRoute() . '_new';
	}
	
	/**
	 * Get copy route (e.g. admin_branches_copy)
	 *
	 * @return string
	 */
	protected function getCopyRoute() {
		return $this->getIndexRoute() . '_copy';
	}
	
	/**
	 * Get index route (e.g. admin_branches)
	 *
	 * @return string
	 */
	protected function getIndexRoute() {
		return 'admin_' . ClassUtils::getClassName($this->getEntityType());
	}
}