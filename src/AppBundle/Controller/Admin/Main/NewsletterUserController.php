<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\SimpleController;
use AppBundle\Entity\Main\NewsletterUser;
use AppBundle\Entity\Other\ImportNewsletterUsers;
use AppBundle\Factory\Admin\Import\FileEntryFactory;
use AppBundle\Factory\Admin\Import\NewsletterUser\ImportErrorFactory;
use AppBundle\Factory\Admin\Import\NewsletterUser\PreparedEntryFactory;
use AppBundle\Filter\Common\Main\NewsletterUserFilter;
use AppBundle\Form\Editor\Admin\Main\NewsletterUserEditorType;
use AppBundle\Form\Filter\Admin\Main\NewsletterUserFilterType;
use AppBundle\Form\Other\ImportNewsletterUsersType;
use AppBundle\Logic\Admin\Import\NewsletterUser\ImportLogic;
use AppBundle\Logic\Admin\Import\NewsletterUser\ImportValidator;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Common\Main\NewsletterUserManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Admin\NewsletterUserEntryParamsManager;
use AppBundle\Misc\FormOptions\FormOptionsProvider;
use AppBundle\Repository\Admin\Main\NewsletterGroupRepository;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserController extends SimpleController {
	
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

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIMPublishedAction(Request $request, $id) {
		return $this->setIMPublishedActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIPPublishedAction(Request $request, $id) {
		return $this->setIPPublishedActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setSubscribedAction(Request $request, $id) {
		return $this->setSubscribedActionInternal($request, $id);
	}

	public function importAction(Request $request) {
		return $this->importActionInternal($request);
	}
	
	// ------------------------------------------------------------------------
	// Internal actions
	// ------------------------------------------------------------------------
	protected function setSubscribedActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getSetInfomarketRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$subscribed = $request->get('value', false);
		
		$em = $this->getDoctrine()->getManager();
		
		$entry->setSubscribed($subscribed);
		$em->persist($entry);
		$em->flush();
		
		return $this->redirectToReferer($request);
	}

	protected function importActionInternal(Request $request) {
		$params = $this->createParams($this->getImportRoute());
		$params = $this->getImportParams($request, $params);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		$importItem = new ImportNewsletterUsers();
		
		$optionsProvider = $this->getImportFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$importForm = $this->createForm(ImportNewsletterUsersType::class, $importItem, $options);
		$importForm->handleRequest($request);
		
		if ($importForm->isSubmitted() && $importForm->isValid()) {
			
			// TODO configure in services!
			$translator = $this->get('translator');
			$errorFactory = new ImportErrorFactory($translator);
			$fileEntryFactory = new FileEntryFactory($errorFactory);
			
			$preparedEntryFactory = $this->get(PreparedEntryFactory::class);
			
			$validator = new ImportValidator($errorFactory);
			
			$logic = new ImportLogic($this->getDoctrine(), $errorFactory, $fileEntryFactory, 
					$preparedEntryFactory, $validator);
			$result = $logic->import($importItem);
			$errors = $result['errors'];
			if (count($errors) > 0) {
				foreach ($errors as $error) {
					$this->addFlash('error', $error);
				}
			} else {
				$translator = $this->get('translator');
				
				$lines = $result['lines'];
				
				$createdItems = $result['itemsCounts']['created'];
				$updatedItems = $result['itemsCounts']['updated'];
				$duplicateItems = $result['itemsCounts']['duplicates'];
				$allItems = $result['itemsCounts']['all'];
				
				$createdAssignments = $result['assignmentsCounts']['created'];
				$updatedAssignments = $result['assignmentsCounts']['updated'];
				$allAssignments = $result['assignmentsCounts']['all'];
				
				$msg = $translator->trans('success.newsletterUser.import');
				$msg = nl2br($msg);
				
				$msg = str_replace('%lines%', $lines, $msg);
				
				$msg = str_replace('%createdItems%', $createdItems, $msg);
				$msg = str_replace('%updatedItems%', $updatedItems, $msg);
				$msg = str_replace('%duplicateItems%', $duplicateItems, $msg);
				$msg = str_replace('%allItems%', $allItems, $msg);
				
				$msg = str_replace('%createdAssignments%', $createdAssignments, $msg);
				$msg = str_replace('%updatedAssignments%', $updatedAssignments, $msg);
				$msg = str_replace('%allAssignments%', $allAssignments, $msg);
				
				$this->addFlash('success', $msg);
			}
			
			return $this->redirectToReferer($request);
		}
		
		$viewParams = $params['viewParams'];
		$viewParams['importForm'] = $importForm->createView();
		
		return $this->render($this->getImportView(), $viewParams);
	}
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	protected function getFilterFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.filter.main.newsletter_user');
	}
	
	/**
	 * @return FormOptionsProvider
	 */
	protected function getImportFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.other.newsletter_user_import');
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function getListItemsProvider() {
		return $this->get('app.misc.provider.name_list_items_provider');
	}
	
	// ---------------------------------------------------------------------------
	// Params
	// ---------------------------------------------------------------------------
	protected function getImportParams(Request $request, array $params) {
		return $this->getParams($request, $params);
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$newsletterGroupRepository = $this->get(NewsletterGroupRepository::class);
		return new NewsletterUserEntryParamsManager($em, $fm, $newsletterGroupRepository);
	}

	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(NewsletterUserManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new NewsletterUserFilter());
	}
	
	// ---------------------------------------------------------------------------
	// Roles
	// ---------------------------------------------------------------------------
	protected function getShowRole() {
		return 'ROLE_ADMIN';
	}

	protected function getEditRole() {
		return 'ROLE_ADMIN';
	}
	
	// ------------------------------------------------------------------------
	// EntityType related
	// ------------------------------------------------------------------------
	protected function getEntityType() {
		return NewsletterUser::class;
	}
	
	// ------------------------------------------------------------------------
	// Forms
	// ------------------------------------------------------------------------
	protected function getEditorFormType() {
		return NewsletterUserEditorType::class;
	}

	protected function getFilterFormType() {
		return NewsletterUserFilterType::class;
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getImportRoute() {
		return $this->getIndexRoute() . '_import';
	}
	
	// ---------------------------------------------------------------------------
	// Views
	// ---------------------------------------------------------------------------
	protected function getImportView() {
		return $this->getDomain() . '/' . $this->getEntityName() . '/import.html.twig';
	}
}