<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\BaseController;
use AppBundle\Entity\Main\BenchmarkMessage;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Main\User;
use AppBundle\Factory\Common\Choices\Bool\ReadChoicesFactory;
use AppBundle\Factory\Common\Choices\Enum\BenchmarkMessageStatesFactory;
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

	protected function listFormActionInternal(Request $request, Form $form, BaseFilter $filter, array $listItems) {
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
		
		return parent::listFormActionInternal($request, $form, $filter, $listItems);
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
		
		$form = $this->createForm($this->getEditorFormType(), $newEntry, $this->getEditorFormOptions());
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			if ($form->get('save')->isClicked()) {
				$this->saveEntry($request, $newEntry, $viewParams);
				
				$entry->setState($newEntry->getState());
				$this->saveEntry($request, $entry, $viewParams);
				
				$this->flashCreatedMessage();
				
				return $this->redirectToRoute($this->getShowRoute(), array('id' => $entry->getId()));
			}
		}
		
		$viewParams['newMessageForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}
	
	// ------------------------------------------------------------------------
	// Internal logic
	// ------------------------------------------------------------------------
	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
		
		$this->addEntityChoicesFormOption($options, Product::class, 'products');
		$this->addEntityChoicesFormOption($options, User::class, 'authors');
		
		$this->addFactoryChoicesFormOption($options, BenchmarkMessageStatesFactory::class, 'states');
		$this->addFactoryChoicesFormOption($options, ReadChoicesFactory::class, 'readByAdmin');
		
		return $options;
	}

	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
		
		$this->addFactoryChoicesFormOption($options, BenchmarkMessageStatesFactory::class, 'state');
		
		return $options;
	}

	protected function setReadEntry(Request $request, $entry, $read = false) {
		$read = $request->get('value', $read);
		
		$em = $this->getDoctrine()->getManager();
		
		$entry->setReadByAdmin($read);
		$em->persist($entry);
		$em->flush();
	}

	/**
	 *
	 * @param BenchmarkMessage $entry        	
	 */
	protected function prepareEntry($request, &$entry, $params) {
		parent::prepareEntry($request, $entry, $params);
		
		$entry->setReadByAdmin(true);
		$entry->setReadByAuthor(false);
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