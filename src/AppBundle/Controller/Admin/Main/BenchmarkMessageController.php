<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\BaseEntityController;
use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Entity\Product;
use AppBundle\Entity\User;
use AppBundle\Filter\Admin\Base\AuditFilter;
use AppBundle\Filter\Admin\Main\BenchmarkMessageFilter;
use AppBundle\Form\Benchmark\BenchmarkMessageType;
use AppBundle\Form\Filter\Admin\Main\BenchmarkMessageFilterType;
use AppBundle\Form\Lists\BenchmarkMessageListType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Common\BenchmarkMessageManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Admin\BenchmarkMessageParamsManager;
use AppBundle\Repository\Admin\Main\BenchmarkMessageRepository;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use AppBundle\Repository\Admin\Main\ProductRepository;
use AppBundle\Utils\StringUtils;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Base\BaseType;
use AppBundle\Factory\Common\Choices\Base\ChoicesFactory;

class BenchmarkMessageController extends BaseEntityController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	/**
	 * 
	 * @param Request $request
	 * @param integer $page
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function newAction(Request $request)
	{
		return $this->newActionInternal($request);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function copyAction(Request $request, $id)
	{
		return $this->copyActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, $id)
	{
		return $this->editActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id)
	{
		return $this->deleteActionInternal($request, $id);
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
		$entry = $viewParams['entry'];
		$this->setReadEntry($request, $entry);
	
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
	
	//------------------------------------------------------------------------
	// Internal logic
	//------------------------------------------------------------------------
	
	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
	
		/** @var ProductRepository $categoryRepository */
		$productRepository = $this->getDoctrine()->getRepository(Product::class);
		$options[BaseType::getChoicesName('product')] = $productRepository->findFilterItems();
		
		/** @var UserRepository $categoryRepository */
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		$options[BaseType::getChoicesName('user')] = $userRepository->findFilterItems();
	
		return $options;
	}
	
	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
		
		/** @var ChoicesFactory $statesFactory */
		$statesFactory = $this->get('app.factory.choices.benchmarkMessage.states');
		$options[BaseType::getChoicesName('state')] = $statesFactory->getItems();
		
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
	
	/**
	 *
	 * @param BenchmarkMessage $entry
	 */
	protected function prepareEntry($request, &$entry, $params) {
		parent::prepareEntry($request, $entry, $params);
		
		$entry->setReadByAdmin(true);
		$entry->setReadByAuthor(false);
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getEntityManager($doctrine, $paginator) {
		$tokenStorage = $this->get('security.token_storage');
		return new BenchmarkMessageManager($doctrine, $paginator, $tokenStorage);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new BenchmarkMessageFilter());
	}
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new BenchmarkMessageParamsManager($em, $fm, $doctrine);
	}
	
	
	//------------------------------------------------------------------------
	// EntityType related
	//------------------------------------------------------------------------
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getEntityType()
	 */
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
	
	
	//------------------------------------------------------------------------
	// Forms
	//------------------------------------------------------------------------
	
	protected function getEditorFormType() {
		return BenchmarkMessageType::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFilterFormType()
	 */
	protected function getFilterFormType() {
		return BenchmarkMessageFilterType::class;
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
		return $this->isGranted($this->getAdminRole());
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	protected function getSetReadRoute()
	{
		return $this->getIndexRoute() . '_set_read';
	}
}