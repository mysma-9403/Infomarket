<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\BaseController;
use AppBundle\Entity\Main\BenchmarkMessage;
use AppBundle\Filter\Common\Base\BaseFilter;
use AppBundle\Filter\Common\Main\BenchmarkMessageFilter;
use AppBundle\Form\Editor\Admin\Main\BenchmarkMessageEditorType;
use AppBundle\Form\Filter\Admin\Main\BenchmarkMessageFilterType;
use AppBundle\Form\Lists\BenchmarkMessageListType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Common\Main\BenchmarkMessageManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Admin\BenchmarkMessageParamsManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BenchmarkMessageController extends BaseController {
	
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	/**
	 *
	 * @param Request $request        	
	 * @param integer $page        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function newAction(Request $request) {
		return $this->newActionInternal($request);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function copyAction(Request $request, $id) {
		return $this->copyActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, $id) {
		return $this->editActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id) {
		return $this->deleteActionInternal($request, $id);
	}

	public function setReadAction(Request $request, $id) {
		return $this->setReadActionInternal($request, $id);
	}
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	protected function showActionInternal(Request $request, $id) {
		// TODO I don't like this override and duplicate actions -> maybe save should be moved to Manager?? or ActionInternal should be splitted?
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getSetReadRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		$this->setReadEntry($request, $entry, true);
		
		return parent::showActionInternal($request, $id);
	}

	protected function setReadActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getSetReadRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		$this->setReadEntry($request, $entry);
		
		return $this->redirectToReferer($request);
	}

	protected function listFormActionInternal(Request $request, Form $form, BaseFilter $filter, array $listItems, 
			array $params) {
		if ($form->get('setReadSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setValueForSelected($entries, 'readByAdmin', 1);
		}
		
		if ($form->get('setUnreadSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setValueForSelected($entries, 'readByAdmin', 0);
		}
		
		return parent::listFormActionInternal($request, $form, $filter, $listItems, $params);
	}
	
	// ---------------------------------------------------------------------------
	// Actions blocks
	// ---------------------------------------------------------------------------
	protected function initShowForms(Request $request, array &$params) {
		$response = parent::initShowForms($request, $params);
		if ($response)
			return $response;
		
		$response = $this->initNewMessageForm($request, $params);
		if ($response)
			return $response;
		
		return null;
	}

	protected function initNewMessageForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		/** @var BenchmarkMessage $entry */
		$entry = $viewParams['entry'];
		/** @var BenchmarkMessage $newEntry */
		$newEntry = $viewParams['newEntry'];
		
		$optionsProvider = $this->getEditorFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm($this->getEditorFormType(), $newEntry, $options);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			if ($form->get('save')->isClicked()) {
				$newEntry = $this->getPreparedItem($request, $newEntry, $params);
				$this->saveItem($request, $newEntry, $viewParams);
				
				$entry = $this->getPreparedItem($request, $entry, $params);
				$entry->setState($newEntry->getState());
				$this->saveItem($request, $entry, $viewParams);
				
				$this->flashCreatedMessage();
				
				return $this->redirectToRoute($this->getShowRoute(), array('id' => $entry->getId()));
			}
		}
		
		$viewParams['newMessageForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	protected function getFilterFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.filter.main.benchmark_message');
	}

	protected function getEditorFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.editor.main.benchmark_message');
	}
	
	// ------------------------------------------------------------------------
	// Internal logic
	// ------------------------------------------------------------------------
	protected function getListItemsProvider() {
		return $this->get('app.misc.provider.name_list_items_provider');
	}

	protected function setReadEntry(Request $request, $entry, $read = false) {
		$read = $request->get('value', $read);
		
		$em = $this->getDoctrine()->getManager();
		
		$entry->setReadByAdmin($read);
		$em->persist($entry);
		$em->flush();
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(BenchmarkMessageManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new BenchmarkMessageFilter());
	}

	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new BenchmarkMessageParamsManager($em, $fm, $doctrine);
	}
	
	// ------------------------------------------------------------------------
	// EntityType related
	// ------------------------------------------------------------------------
	protected function getEntityType() {
		return BenchmarkMessage::class;
	}
	
	// ------------------------------------------------------------------------
	// Forms
	// ------------------------------------------------------------------------
	protected function getEditorFormType() {
		return BenchmarkMessageEditorType::class;
	}

	protected function getFilterFormType() {
		return BenchmarkMessageFilterType::class;
	}

	protected function getListFormType() {
		return BenchmarkMessageListType::class;
	}
	
	// ---------------------------------------------------------------------------
	// Permissions
	// ---------------------------------------------------------------------------
	protected function canEdit() {
		return false;
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getSetReadRoute() {
		return $this->getIndexRoute() . '_set_read';
	}
}