<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Admin\Base\BaseEntityController;
use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Entity\Product;
use AppBundle\Factory\Common\Choices\Bool\ReadChoicesFactory;
use AppBundle\Factory\Common\Choices\Enum\BenchmarkMessageStatesFactory;
use AppBundle\Filter\Admin\Base\AuditFilter;
use AppBundle\Filter\Benchmark\BenchmarkMessageFilter;
use AppBundle\Form\Editor\Benchmark\BenchmarkMessageEditorType;
use AppBundle\Form\Filter\Benchmark\BenchmarkMessageFilterType;
use AppBundle\Form\Lists\BenchmarkMessageListType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Benchmark\BenchmarkMessageManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;
use AppBundle\Manager\Params\EntryParams\Benchmark\BenchmarkMessageParamsManager;
use AppBundle\Repository\Benchmark\BenchmarkMessageRepository;
use AppBundle\Utils\StringUtils;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkMessageController extends BaseEntityController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}
	
	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}
	
	public function newAction(Request $request) {
		return $this->newActionInternal($request);
	}
	
	public function setReadAction(Request $request, $id)
	{
		return $this->setReadActionInternal($request, $id);
	}
	
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	protected function showActionInternal(Request $request, $id)
	{
		//TODO I don't like this override and duplicate actions -> maybe save should be moved to Manager?? or ActionInternal should be splitted?
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getSetReadRoute());
		$params = $this->getEditParams($request, $params, $id);
	
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		$this->setReadEntry($request, $entry, true);
	
		return parent::showActionInternal($request, $id);
	}
	
	protected function setReadActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
	
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
	
	protected function listFormActionInternal(Request $request, Form $form, AuditFilter $filter, array $listItems) {
	
		if ($form->get('setReadSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setReadSelected($entries, 1);
		}
	
		if ($form->get('setUnreadSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setReadSelected($entries, 0);
		}
	
		return parent::listFormActionInternal($request, $form, $filter, $listItems);
	}
	
	//---------------------------------------------------------------------------
	// Actions blocks
	//---------------------------------------------------------------------------
	
	protected function initShowForms(Request $request, array &$params) {
		$response = parent::initShowForms($request, $params);
		if($response) return $response;
	
		$response = $this->initNewMessageForm($request, $params);
		if($response) return $response;
	
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
	
		if ($form->isSubmitted() && $form->isValid())
		{
			if ($form->get('save')->isClicked()) {
				$this->saveEntry($request, $newEntry, $viewParams);
				
				$entry->setState($newEntry->getState());
				$this->saveEntry($request, $entry, $viewParams);
	
				$translator = $this->get('translator');
				$message = $translator->trans('success.created');
				$message = str_replace('%type%', '<b>' . StringUtils::getClassName($this->getEntityType()) . '</b>', $message);
				$this->addFlash('success', $message);
	
				return $this->redirectToRoute($this->getShowRoute(), array('id' => $entry->getId()));
			}
		}
	
		$viewParams['newMessageForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
	
		return null;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalContextParamsManager($doctrine, $lastRouteParams) {
		$tokenStorage = $this->get('security.token_storage');
		return new ContextParamsManager($doctrine, $lastRouteParams, $tokenStorage);
	}
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new BenchmarkMessageParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		$tokenStorage = $this->get('security.token_storage');
		return new BenchmarkMessageManager($doctrine, $paginator, $tokenStorage);
	}
	
	protected function getFilterManager($doctrine) {
		$tokenStorage = $this->get('security.token_storage');
		$user = $tokenStorage->getToken()->getUser()->getId();
		
		$filter = new BenchmarkMessageFilter();
		$filter->setContextUser($user);
		
		return new FilterManager($filter);
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
	
		$this->addEntityChoicesFormOption($options, Product::class, 'products');
		
		$this->addFactoryChoicesFormOption($options, BenchmarkMessageStatesFactory::class, 'states');
		$this->addFactoryChoicesFormOption($options, ReadChoicesFactory::class, 'readByAuthor');
	
		return $options;
	}
	
	protected function getListItemKeyFields($item) {
		$fields = parent::getListItemKeyFields($item);
	
		$fields[] = $item['name'];
	
		return $fields;
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
	
	/**
	 *
	 * @param array $entries
	 * @param boolean $read
	 */
	protected function setReadSelected($items, $read)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
	
		if(count($items) > 0) {
			/** @var BenchmarkMessageRepository $repository */
			$repository = $this->getEntityRepository();
			$repository->setRead($items, $read);
		}
	}
	
	//---------------------------------------------------------------------------
	// Permissions
	//---------------------------------------------------------------------------
	
	protected function canEdit() {
		return false;
	}
	
	protected function canCreate() {
		return false;
	}
	
	protected function canCopy() {
		return false;
	}
	
	protected function canDelete() {
		return false;
	}
	
	protected function isAdmin() {
		return false;
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
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
	 * @return BaseEntityListType
	 */
	protected function getListFormType() {
		return BenchmarkMessageListType::class;
	}
	
	protected function getEntityRepository()
	{
		$em = $this->getDoctrine()->getManager();
		return new BenchmarkMessageRepository($em, $em->getClassMetadata($this->getEntityType()));
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	
	protected function getShowRole() {
		return 'ROLE_BENCHMARK';
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	protected function getEditRoute()
	{
		return $this->getShowRoute();
	}
	
	protected function getSetReadRoute()
	{
		return $this->getIndexRoute() . '_set_read';
	}
	
	//---------------------------------------------------------------------------
	// Domain
	//---------------------------------------------------------------------------
	
	protected function getDomain() {
		return 'benchmark';
	}
}