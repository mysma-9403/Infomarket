<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Admin\Base\BaseController;
use AppBundle\Entity\Main\BenchmarkMessage;
use AppBundle\Filter\Benchmark\BenchmarkMessageFilter;
use AppBundle\Filter\Common\Base\BaseFilter;
use AppBundle\Form\Editor\Benchmark\BenchmarkMessageEditorType;
use AppBundle\Form\Filter\Benchmark\BenchmarkMessageFilterType;
use AppBundle\Form\Lists\BenchmarkMessageListType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Benchmark\BenchmarkMessageManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;
use AppBundle\Manager\Params\EntryParams\Benchmark\BenchmarkMessageParamsManager;
use AppBundle\Repository\Benchmark\BenchmarkMessageRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkMessageController extends BaseController {
	
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}

	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}

	public function newAction(Request $request) {
		return $this->newActionInternal($request);
	}

	public function setReadAction(Request $request, $id) {
		return $this->setReadActionInternal($request, $id);
	}
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	protected function showActionInternal(Request $request, $id) {
		// TODO I don't like this override and duplicate actions -> maybe save should be moved to Manager?? or ActionInternal should be splitted?
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getSetReadRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		$this->setReadEntry($request, $entry, true);
		
		return parent::showActionInternal($request, $id);
	}

	protected function setReadActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getSetReadRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		/** @var BenchmarkMessage $entry */
		$entry = $viewParams['entry'];
		
		$read = $request->get('value', false);
		
		$em = $this->getDoctrine()->getManager();
		
		$entry->setReadByAuthor($read);
		$em->persist($entry);
		$em->flush();
		
		return $this->redirectToReferer($request);
	}

	protected function listFormActionInternal(Request $request, Form $form, BaseFilter $filter, array $listItems) {
		if ($form->get('setReadSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setValueForSelected($entries, 'readByAuthor', 1);
		}
		
		if ($form->get('setUnreadSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setValueForSelected($entries, 'readByAuthor', 0);
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
		
		$form = $this->createForm($this->getEditorFormType(), $newEntry);
		
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
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getInternalContextParamsManager($doctrine, $lastRouteParams) {
		return $this->get(ContextParamsManager::class);
	}

	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$productRepository = $this->get(ProductRepository::class);
		return new BenchmarkMessageParamsManager($em, $fm, $productRepository);
	}

	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(BenchmarkMessageManager::class);
	}

	protected function getFilterManager($doctrine) {
		$tokenStorage = $this->get('security.token_storage');
		$user = $tokenStorage->getToken()->getUser()->getId();
		
		$filter = new BenchmarkMessageFilter();
		$filter->setContextUser($user);
		
		return new FilterManager($filter);
	}
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	protected function getFilterFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.filter.benchmark.benchmark_message');
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function getListItemsProvider() {
		return $this->get('app.misc.provider.name_list_items_provider');
	}

	protected function setReadEntry(Request $request, $entry, $read = false) {
		$read = $request->get('value', $read);
		
		$em = $this->getDoctrine()->getManager();
		
		$entry->setReadByAuthor($read);
		$em->persist($entry);
		$em->flush();
	}

	/**
	 *
	 * @param BenchmarkMessage $entry        	
	 */
	protected function prepareEntry($request, &$entry, $params) {
		$tokenStorage = $this->get('security.token_storage');
		
		$entry->setAuthor($tokenStorage->getToken()->getUser());
		
		$entry->setReadByAdmin(false);
		$entry->setReadByAuthor(true);
	}
	
	// ---------------------------------------------------------------------------
	// Permissions
	// ---------------------------------------------------------------------------
	protected function canEdit() {
		return false;
	}

	protected function isAdmin() {
		return false;
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function getEditorFormType() {
		return BenchmarkMessageEditorType::class;
	}

	protected function getFilterFormType() {
		return BenchmarkMessageFilterType::class;
	}

	protected function getEntityType() {
		return BenchmarkMessage::class;
	}

	/**
	 *
	 * @return BaseListType
	 */
	protected function getListFormType() {
		return BenchmarkMessageListType::class;
	}

	protected function getEntityRepository() {
		$em = $this->getDoctrine()->getManager();
		return new BenchmarkMessageRepository($em, $em->getClassMetadata($this->getEntityType()));
	}
	
	// ---------------------------------------------------------------------------
	// Roles
	// ---------------------------------------------------------------------------
	protected function getShowRole() {
		return 'ROLE_USER';
	}
	
	protected function getEditRole() {
		return $this->getShowRole();
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getEditRoute() {
		return $this->getShowRoute();
	}

	protected function getSetReadRoute() {
		return $this->getIndexRoute() . '_set_read';
	}
	
	// ---------------------------------------------------------------------------
	// Domain
	// ---------------------------------------------------------------------------
	protected function getDomain() {
		return 'benchmark';
	}
}