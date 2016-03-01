<?php

namespace AppBundle\Controller\Admin\Base;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Stof\DoctrineExtensionsBundle\Uploadable\UploadedFileInfo;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;

abstract class SimpleEntityController extends Controller
{
	public function indexAction(Request $request, $page)
	{
		$filter = new SimpleEntityFilter();
		$filter->initValues($request);
		
		$filterForm = $this->createForm($this->getFilterFormClass(), $filter);
		
		$filterForm->handleRequest($request);
			
		if ($filterForm->isSubmitted() && $filterForm->isValid()) {
			if ($filterForm->get('search')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getValues());
			}
			
			if ($filterForm->get('clear')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), array('selected' => $filter->getSelected()));
			}
		}
		
		$repository = $this->getRepository();
		$query = $repository->querySelected($filter);
		 
		$paginator = $this->get('knp_paginator');
		$entries = $paginator->paginate($query, $page, 10); //TODO count settings?
		$entries->setUsedRoute($this->getIndexRoute());
		 
		$entryList = $this->createNewList();
		
		foreach ($entries as $entry) {
			if(in_array($entry->getId(), $filter->getSelected())) {
				$entryList->addEntry($entry);
			}
		}
		 
		$form = $this->createForm($this->getListFormClass(), $entryList, array('choices' => $entries));
		 
		$form->handleRequest($request);
		 
		if ($form->isSubmitted() && $form->isValid())
		{
			if ($form->get('new')->isClicked()) {
				return $this->redirectToRoute($this->getNewRoute());
			}
	
			if ($form->get('selectAll')->isClicked()) {
				foreach ($entries as $entry) {
					$filter->addSelected($entry->getId());
				}
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getValues());
			}
			
			if ($form->get('selectNone')->isClicked()) {
				$filter->clearSelected();
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getValues());
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
			
			if ($form->get('deleteSelected')->isClicked()) {
				$data = $form->getData();
				$entries = $data->getEntries();
				$this->deleteSelected($entries);
			}
			 
			return $this->redirectToRoute($this->getIndexRoute(), $filter->getValues());
		}
		 
		return $this->render($this->getTwigList(), array(
				'entries' => $entries,
				'filter' => $filterForm->createView(),
				'form' => $form->createView()
		));
	}
	
	/**
	 * Get repository for $this entity
	 *
	 * @return SimpleEntityRepository
	 */
	protected function getRepository() {
		return $this->getDoctrine()->getRepository($this->getEntityType());
	}
	
	/**
     * Get entity type (e.g. 'AppBundle:Branch')
     *
     * @return string
     */
	protected abstract function getEntityType();
	
	/**
	 * Get entity class (e.g. Bundle::class)
	 *
	 * @return mixed
	 */
	protected abstract function getEntityClass();
	
	/**
	 * Get entity list class (e.g. BundleList::class)
	 *
	 * @return mixed
	 */
	protected abstract function getEntityListClass();
	
	/**
	 * Get form class (e.g. BundleType::class)
	 *
	 * @return mixed
	 */
	protected abstract function getFormClass();
	
	/**
	 * Get entity list class (e.g. BundleListType::class)
	 *
	 * @return mixed
	 */
	protected abstract function getListFormClass();
	
	/**
	 * Get entity filter class (e.g <strong>SimpleEntityFilterType::class</strong>)
	 *
	 * @return mixed
	 */
	protected function getFilterFormClass() {
		return SimpleEntityFilterType::class;
	}
	
	/**
	 * Get twig list path (e.g. admin/branch/list.html.twig)
	 *
	 * @return string
	 */
	protected function getTwigList() {
		return 'admin/' . $this->getTwigName() . '/list.html.twig';
	}
	
	/**
	 * Get twig editor path (e.g. admin/branch/editor.html.twig)
	 *
	 * @return string
	 */
	protected function getTwigEditor() {
		return 'admin/' . $this->getTwigName() . '/editor.html.twig';
	}
	
	/**
	 * Get twig show path (e.g. admin/branch/show.html.twig)
	 *
	 * @return string
	 */
	protected function getTwigShow() {
		return 'admin/' . $this->getTwigName() . '/show.html.twig';
	}
	
	/**
	 * Get twig name (e.g <strong>branches</strong>)
	 *
	 * @return string
	 */
	protected abstract function getTwigName();
	
	public function showAction($id)
	{
		$entry = $this->getEntry($id);
		return $this->render($this->getTwigShow(), array('entry' => $entry));
	}
	
	public function newAction(Request $request) 
	{
		$entry = $this->createNewEntry();
		return $this->editEntry($request, $entry);
	}
	
	public function copyAction(Request $request, $id)
	{
		$entry = $this->getEntry($id);
		$entry = $this->createFromTemplate($entry);
		return $this->editEntry($request, $entry);
	}
	
	/**
	 * Create new list (e.g. new BranchList())
	 *
	 * @return mixed
	 */
	protected abstract function createNewList();
	
	/**
	 * Create new entry (e.g. new Branch())
	 *
	 * @return mixed
	 */
	protected abstract function createNewEntry();
	
	/**
	 * Create new entry as a copy of a $template
	 *
	 * @param mixed $template
	 *
	 * @return mixed
	 */
	protected function createFromTemplate($template) {
		$entry = $this->createNewEntry();
		
		$entry->setName($template->getName());
		$entry->setDescription($template->getDescription());
		
		return $entry;
	}
	
	public function editAction(Request $request, $id)
	{
		$entry = $this->getEntry($id);
		return $this->editEntry($request, $entry);
	}
	
	public function editEntry(Request $request, $entry)
	{
		$form = $this->createForm($this->getFormClass(), $entry);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid())
		{	
			$em = $this->getDoctrine()->getManager();
			
// 			$listener = $this->container->get('gedmo.listener.uploadable');
// 			$listener->addEntityFileInfo($entry, $entry->getFile()->getFileInfo());

			if($entry->getFile()) {
				$uploadableManager = $this->get('stof_doctrine_extensions.uploadable.manager');
				$uploadableManager->markEntityToUpload($entry, new UploadedFileInfo($entry->getFile()));
			}
			
			$em->persist($entry);
			$em->flush();
				
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
	
	protected function getEntry($id) {
		$repository = $this->getDoctrine()->getRepository($this->getEntityType());
		$entry = $repository->find($id);
		
		if (!$entry) {
			throw $this->createNotFoundException('No entry found for id '.$id);
		}
		
		return $entry;
	}
	
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
	protected abstract function getIndexRoute();
	
	public function deleteAction(Request $request, $id)
	{
		$em = $this->getDoctrine()->getManager();
		
		//Make sure entity exists :)
		$entry = $this->getEntry($id);
		$em->remove($entry);
		$em->flush();
	
		return $this->redirectToRoute($this->getIndexRoute());
	}
	
	public function publishAction($id)
	{
		$em = $this->getDoctrine()->getManager();
	
		$entry = $this->getEntry($id);
		$entry->setPublished(true);
		
		$em->persist($entry);
		$em->flush();
		
		return $this->redirectToRoute($this->getIndexRoute());
	}
	
	public function unpublishAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		
		$entry = $this->getEntry($id);
		$entry->setPublished(false);
		
		$em->persist($entry);
		$em->flush();
		
		return $this->redirectToRoute($this->getIndexRoute());
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
	
	public function deleteSelected($entries)
	{
		$em = $this->getDoctrine()->getManager();
		
		foreach ($entries as $entry)
			$em->remove($entry);
		
		$em->flush();
	}
}