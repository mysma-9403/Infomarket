<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\NewsletterGroup;
use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Entity\Other\ImportNewsletterUsers;
use AppBundle\Filter\Admin\Main\NewsletterUserFilter;
use AppBundle\Form\Editor\Main\NewsletterUserEditorType;
use AppBundle\Form\Filter\Admin\Main\NewsletterUserFilterType;
use AppBundle\Form\Other\ImportNewsletterUsersType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Common\NewsletterUserManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Admin\NewsletterUserEntryParamsManager;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserController extends SimpleEntityController {
	
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
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIMPublishedAction(Request $request, $id)
	{
		return $this->setIMPublishedActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIPPublishedAction(Request $request, $id)
	{
		return $this->setIPPublishedActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setSubscribedAction(Request $request, $id)
	{
		return $this->setSubscribedActionInternal($request, $id);
	}
	
	public function importAction(Request $request)
	{
		return $this->importActionInternal($request);
	}
	
	//------------------------------------------------------------------------
	// Internal actions
	//------------------------------------------------------------------------
	protected function setSubscribedActionInternal(Request $request, $id)
	{
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
	
	protected function importActionInternal(Request $request)
	{
		$params = $this->createParams($this->getImportRoute());
		$params = $this->getImportParams($request, $params);
	
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
	
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
	
		$importItem = new ImportNewsletterUsers();
	
		$importForm = $this->createForm(ImportNewsletterUsersType::class, $importItem);
		$importForm->handleRequest($request);
	
		if ($importForm->isSubmitted() && $importForm->isValid()) {
				
			$result = $this->import($importItem);
			$errors = $result['errors'];
			if(count($errors) > 0) {
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
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function deleteMore($entry)
	{
		$em = $this->getDoctrine()->getManager();
		
		foreach ($entry->getNewsletterUserNewsletterGroupAssignments() as $newsletterUserNewsletterGroupAssignment) {
			$em->remove($newsletterUserNewsletterGroupAssignment);
		}
		$em->flush();
		
		foreach ($entry->getNewsletterUserNewsletterPageAssignments() as $newsletterUserNewsletterPageAssignment) {
			$em->remove($newsletterUserNewsletterPageAssignment);
		}
		$em->flush();
	
		return array();
	}
	
	/**
	 *
	 * @param ImportRatings $importRatings
	 */
	protected function import($importItem) {
		$result = array();
	
		$fileEntries = $this->getFileEntries($importItem);
	
		$preparedEntries = $this->getPreparedEntries($fileEntries);
		$errors = $this->getEntriesErrors($preparedEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
	
		$preparedEntries = $this->checkDuplicates($preparedEntries);
		$errors = $this->getEntriesErrors($preparedEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
	
		$dataBaseEntries = $this->getDataBaseEntries($preparedEntries);
		$errors = $this->getEntriesErrors($dataBaseEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
	
		$itemsCounts = $this->getItemsCounts($dataBaseEntries);
	
		$errors = $this->saveItems($dataBaseEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
	
		$dataBaseEntries = $this->getPersistentItems($dataBaseEntries);
		$errors = $this->getEntriesErrors($dataBaseEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
	
		$dataBaseEntries = $this->getAssignments($dataBaseEntries, $importItem);
	
		$assignmentsCounts = $this->getAssignmentsCounts($dataBaseEntries);
	
		$errors = $this->saveAssignments($dataBaseEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
		} else {
			$result['errors'] = array();
			$result['lines'] = count($fileEntries);
			$result['itemsCounts'] = $itemsCounts;
			$result['assignmentsCounts'] = $assignmentsCounts;
		}
	
		return $result;
	}
	
	protected function getFileEntries($importItems) {
		$rows = array();
	
		$file = fopen('../web' . $importItems->getImportFile(), 'r');
	
		while( ($row = fgetcsv($file, 1024, ';')) !== FALSE ) {
			$rows[] = $row;
		}
	
		fclose($file);
	
		return $rows;
	}
	
	protected function getPreparedEntries($fileEntries) {
		$entries = array();
	
		$i = 0;
		foreach ($fileEntries as $fileEntry) {
			$i++;
	
			$entry = $this->getPreparedEntry($fileEntry, $i);
			if($entry) $entries[] = $entry;
		}
	
		return $entries;
	}
	
	protected function getPreparedEntry($fileEntry, $i) {
		$entry = array();
		$errors = array();
	
		if(count($fileEntry) <= 0) return null;
	
		$mail = count($fileEntry) > 0 ? $fileEntry[0] : '';
		if(strlen($mail) <= 0) return null;
		
		$subscribed = !(count($fileEntry) > 1 && $fileEntry[1] == '1');
		
		$words = explode(' ', $mail);
		$newMail = '';
		foreach($words as $word) {
			if(strtolower($word) == 'rezygnacja') {
				$subscribed = false;
			} else {
				$newMail .= $word;
			}
		}
		
		$entry['lineNumber'] = $i;
		$entry['mail'] = $newMail;
		$entry['subscribed'] = $subscribed;
		$entry['duplicate'] = false;
		$entry['errors'] = $errors;
	
		return $entry;
	}
	
	protected function checkDuplicates($preparedEntries) {
		$count = count($preparedEntries);
	
		for($i = 0; $i < $count; $i++) {
			$errors = array();
			$prevEntry = $preparedEntries[$i];
				
			$prevMail = $prevEntry['mail'];
				
			for($j = $i+1; $j < $count; $j++) {
				$nextEntry = $preparedEntries[$j];
	
				$nextMail = $nextEntry['mail'];
	
				if($prevMail == $nextMail) {	
					$prevSubscribed = $prevEntry['subscribed'];
					$nextSubscribed = $nextEntry['subscribed'];
						
					if($prevSubscribed != $nextSubscribed) {
						$prevNumber = $prevEntry['lineNumber'];
						$nextNumber = $nextEntry['lineNumber'];
						$errors[] = $this->getInconsistentDataError($prevNumber, $nextNumber, $prevMail);
					}
					
					$nextEntry['duplicate'] = true;
					$preparedEntries[$j] = $nextEntry;
				}
			}
				
			$prevEntry['errors'] = $errors;
			$preparedEntries[$i] = $prevEntry;
		}
	
		return $preparedEntries;
	}
	
	protected function getDataBaseEntries($preparedEntries) {
		$entries = array();
	
		foreach ($preparedEntries as $preparedEntry) {
			if(!$preparedEntry['duplicate']) {
				$entries[] = $this->getDataBaseEntry($preparedEntry);
			}
		}
	
		return $entries;
	}
	
	protected function getDataBaseEntry($preparedEntry) {
		$entry = array();
		$errors = array();
		
		$newsletterUserRepository = $this->getDoctrine()->getRepository(NewsletterUser::class);
		
		$mail = $preparedEntry['mail'];
				
		$item = $newsletterUserRepository->findOneBy(['name' => $mail]);
		
		if(!$item) {
			$item = new NewsletterUser();
			
			$item->setSubscribed($preparedEntry['subscribed']);
			$item->setName($mail);
			$item->setInfomarket(false);
			$item->setInfoprodukt(false);
			
			$entry['itemForUpdate'] = true;
		} else {
			$subscribed = $preparedEntry['subscribed'];
			if($subscribed != $item->getSubscribed()) {
				$item->setSubscribed($subscribed);
				$entry['itemForUpdate'] = true;
			} else {
				$entry['itemForUpdate'] = false;
			}
			
		}
				
		$entry['item'] = $item;
	
		$entry['errors'] = $errors;
		return $entry;
	}
	
	protected function saveItems($dataBaseEntries) {
		$errors = array();
	
		$em = $this->getDoctrine()->getManager();
		$em->getConnection()->beginTransaction();
	
		try {
			foreach ($dataBaseEntries as $dataBaseEntry) {
				$forUpdate = $dataBaseEntry['itemForUpdate'];
	
				if($forUpdate) {
					$item = $dataBaseEntry['item'];
					$em->persist($item);
				}
			}
			$em->flush();
			$em->getConnection()->commit();
		} catch (Exception $ex) {
			$em->getConnection()->rollback();
			$errors[] = $ex->getMessage();
		}
	
		return $errors;
	}
	
	protected function getPersistentItems($dataBaseEntries) {
		$newsletterUserRepository = $this->getDoctrine()->getRepository(NewsletterUser::class);
	
		$count = count($dataBaseEntries);
		for ($i = 0; $i < $count; $i++) {
			$dataBaseEntry = $dataBaseEntries[$i];
			
			/** @var NewsletterUser $item */
			$item = $dataBaseEntry['item'];
			$id = $item->getId();
				
			if($id <= 0) {
				$errors = array();
				$name = $item->getName();
	
				$item = $newsletterUserRepository->findOneBy(['name' => $name]);
				if(!$item) $errors[] = $this->getSaveFailedError($id, $name);
				else $dataBaseEntry['item'] = $item;
	
				$dataBaseEntry['errors'] = $errors;
				$dataBaseEntries[$i] = $dataBaseEntry;
			}
		}
	
		return $dataBaseEntries;
	}
	
	protected function getAssignments($dataBaseEntries, ImportNewsletterUsers $importItem) {
		
		$newDataBaseEntries = array();
		
		$assignmentRepository = $this->getDoctrine()->getRepository(NewsletterUserNewsletterGroupAssignment::class);
	
		/** @var ObjectManager $em */
		$em = $this->getDoctrine()->getEntityManager();
		
		$newsletterGroups = array();
		foreach ($importItem->getNewsletterGroups() as $newsetterGroupId) {
			$newsletterGroups[] = $em->getReference(NewsletterGroup::class, $newsetterGroupId);
		}
		
		$count = count($dataBaseEntries);
		for ($i = 0; $i < $count; $i++) {
			$dataBaseEntry = $dataBaseEntries[$i];
				
			$item = $dataBaseEntry['item'];
	
			foreach ($newsletterGroups as $newsetterGroup) {
				$assignment = $assignmentRepository->findOneBy(['newsletterUser' => $item, 'newsletterGroup' => $newsetterGroup]);
					
				if(!$assignment) {
					$assignment = new NewsletterUserNewsletterGroupAssignment();
		
					$assignment->setNewsletterUser($item);
					$assignment->setNewsletterGroup($newsetterGroup);
		
					$dataBaseEntry['assignmentForUpdate'] = true;
				} else {
					$dataBaseEntry['assignmentForUpdate'] = false;
				}
					
				$dataBaseEntry['assignment'] = $assignment;
					
				$newDataBaseEntries[] = $dataBaseEntry;
			}
		}
	
		return $newDataBaseEntries;
	}
	
	protected function saveAssignments($dataBaseEntries) {
		$errors = array();
	
		$em = $this->getDoctrine()->getManager();
		$em->getConnection()->beginTransaction();
	
		try {
			foreach ($dataBaseEntries as $dataBaseEntry) {
				$forUpdate = $dataBaseEntry['assignmentForUpdate'];
	
				if($forUpdate) {
					$assignment = $dataBaseEntry['assignment'];
					$em->persist($assignment);
				}
			}
			$em->flush();
			$em->getConnection()->commit();
		} catch (Exception $ex) {
			$em->getConnection()->rollback();
			$errors[] = $ex->getMessage();
		}
	
		return $errors;
	}
	
	protected function getItemsCounts($dataBaseEntries) {
		$counts = array();
	
		$all = 0;
		$created = 0;
		$updated = 0;
		$duplicates = 0;
	
		foreach ($dataBaseEntries as $dataBaseEntry) {
			$all++;
				
			if($dataBaseEntry['itemForUpdate']) {
				$item = $dataBaseEntry['item'];
				if($item->getId() <= 0) $created++;
				else $updated++;
			} else {
				$item = $dataBaseEntry['item'];
				if($item->getId() <= 0) $duplicates++;
			}
		}
	
		$counts['all'] = $all;
		$counts['created'] = $created;
		$counts['updated'] = $updated;
		$counts['duplicates'] = $duplicates;
	
		return $counts;
	}
	
	protected function getAssignmentsCounts($dataBaseEntries) {
		$counts = array();
	
		$all = 0;
		$created = 0;
		$updated = 0;
	
		foreach ($dataBaseEntries as $dataBaseEntry) {
			$all++;
	
			if($dataBaseEntry['assignmentForUpdate']) {
				$assignment = $dataBaseEntry['assignment'];
				if($assignment->getId() <= 0) $created++;
				else $updated++;
			}
		}
	
		$counts['all'] = $all;
		$counts['created'] = $created;
		$counts['updated'] = $updated;
	
		return $counts;
	}
	
	protected function getEntriesErrors($entries) {
		$errors = array();
	
		foreach ($entries as $entry) {
			$entryErrors = $entry['errors'];
			if(count($entryErrors) > 0) {
				$errors = array_merge($errors, $entryErrors);
			}
		}
	
		return $errors;
	}
	
	
	
	protected function getInconsistentDataError($prevNumber, $nextNumber, $mail) {
		$translator = $this->get('translator');
	
		$lineMsg = $this->getLinesError($prevNumber, $nextNumber);
	
		$errorMsg = $translator->trans('error.newsletterUser.import.inconsistentData');
		$errorMsg = str_replace('%mail%', $mail, $errorMsg);
	
		return $lineMsg . $errorMsg;
	}
	
	protected function getSaveFailedError($number, $name) {
		$translator = $this->get('translator');
	
		$lineMsg = $this->getLineError($number);
	
		$errorMsg = $translator->trans('error.newsletterUser.import.saveFailed');
		$errorMsg = str_replace('%name%', $name, $errorMsg);
	
		return $lineMsg . $errorMsg;
	}

	protected function getLineError($lineNumber) {
		$translator = $this->get('translator');

		$lineMsg = $translator->trans('error.import.lineNumber');
		$lineMsg = str_replace('%number%', $lineNumber, $lineMsg);

		return $lineMsg;
	}
	
	protected function getLinesError($prevNumber, $nextNumber) {
		$translator = $this->get('translator');
	
		$lineMsg = $translator->trans('error.import.lineNumbers');
		$lineMsg = str_replace('%prevNumber%', $prevNumber, $lineMsg);
		$lineMsg = str_replace('%nextNumber%', $nextNumber, $lineMsg);
	
		return $lineMsg;
	}
	
	//---------------------------------------------------------------------------
	// Params
	//---------------------------------------------------------------------------
	
	protected function getImportParams(Request $request, array $params) {
		return $this->getParams($request, $params);
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new NewsletterUserEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return new NewsletterUserManager($doctrine, $paginator);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new NewsletterUserFilter());
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	protected function getShowRole() {
		return 'ROLE_ADMIN';
	}
	
	protected function getEditRole() {
		return 'ROLE_ADMIN';
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
		return NewsletterUser::class;
	}
	
	
	//------------------------------------------------------------------------
	// Forms
	//------------------------------------------------------------------------
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return NewsletterUserEditorType::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFilterFormType()
	 */
	protected function getFilterFormType() {
		return NewsletterUserFilterType::class;
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	protected function getImportRoute() {
		return $this->getIndexRoute() . '_import';
	}
	
	//---------------------------------------------------------------------------
	// Views
	//---------------------------------------------------------------------------
	
	protected function getImportView()
    {
    	return $this->getDomain() . '/' . $this->getEntityName() . '/import.html.twig';
    }
}