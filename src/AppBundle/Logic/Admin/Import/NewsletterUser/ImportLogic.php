<?php

namespace AppBundle\Logic\Admin\Import\NewsletterUser;

use AppBundle\Entity\NewsletterGroup;
use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Entity\Other\ImportNewsletterUsers;
use AppBundle\Factory\Admin\ErrorFactory;
use AppBundle\Factory\Admin\Import\FileEntryFactory;
use AppBundle\Factory\Admin\Import\NewsletterUser\ImportErrorFactory;
use AppBundle\Factory\Admin\Import\NewsletterUser\PreparedEntryFactory;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ImportLogic {
	
	/**
	 * 
	 * @var Registry
	 */
	protected $doctrine;
	
	/**
	 *
	 * @var ImportErrorFactory
	 */
	protected $errorFactory;
	
	/**
	 * 
	 * @var FileEntryFactory
	 */
	protected $fileEntryFactory;
	
	/**
	 * 
	 * @var PreparedEntryFactory
	 */
	protected $preparedEntryFactory;
	
	/**
	 * 
	 * @var ImportValidator //TODO create interface
	 */
	protected $validator;
	
	
	public function __construct(Registry $doctrine, ImportErrorFactory $errorFactory, 
			FileEntryFactory $fileEntryFactory, PreparedEntryFactory $preparedEntryFactory, ImportValidator $validator) {
		$this->doctrine = $doctrine;
		$this->errorFactory = $errorFactory;
		$this->fileEntryFactory = $fileEntryFactory;
		$this->preparedEntryFactory = $preparedEntryFactory;
		$this->validator = $validator;
	}
	
	
	
	/**
	 *
	 * @param ImportNewsletterUsers $importItem
	 */
	public function import($importItem) {
		$result = array();
	
		$fileEntries = $this->fileEntryFactory->getEntries($importItem->getImportFile());
		$errors = $fileEntries['errors'];
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
		
		$preparedEntries = $this->preparedEntryFactory->getEntries($fileEntries);
		$errors = $this->getEntriesErrors($preparedEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
	
		//TODO move to preparedEntryFactory??
		$preparedEntries = $this->validator->validateEntries($preparedEntries);
		$errors = $this->getEntriesErrors($preparedEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
	
		//TODO make DataBaseEntryFactory
		$dataBaseEntries = $this->getDataBaseEntries($preparedEntries);
		$errors = $this->getEntriesErrors($dataBaseEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
	
		$itemsCounts = $this->getItemsCounts($preparedEntries, $dataBaseEntries);
	
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
		
		$newsletterUserRepository = $this->doctrine->getRepository(NewsletterUser::class);
		
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
	
		$em = $this->doctrine->getManager();
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
		$newsletterUserRepository = $this->doctrine->getRepository(NewsletterUser::class);
	
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
				if(!$item) $errors[] = $this->errorFactory->createSaveFailedError($id, $name);
				else $dataBaseEntry['item'] = $item;
	
				$dataBaseEntry['errors'] = $errors;
				$dataBaseEntries[$i] = $dataBaseEntry;
			}
		}
	
		return $dataBaseEntries;
	}
	
	protected function getAssignments($dataBaseEntries, ImportNewsletterUsers $importItem) {
		
		$newDataBaseEntries = array();
		
		$assignmentRepository = $this->doctrine->getRepository(NewsletterUserNewsletterGroupAssignment::class);
	
		/** @var ObjectManager $em */
		$em = $this->doctrine->getEntityManager();
		
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
	
		$em = $this->doctrine->getManager();
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
	
	protected function getItemsCounts($preparedEntries, $dataBaseEntries) {
		$counts = array();
	
		$all = count($preparedEntries);
		
		$unique = 0;
		$created = 0;
		$updated = 0;
	
		foreach ($dataBaseEntries as $dataBaseEntry) {
			$unique++; 
			if($dataBaseEntry['itemForUpdate']) {
				$item = $dataBaseEntry['item'];
				if($item->getId() <= 0) $created++;
				else $updated++;
			}
		}
	
		$counts['all'] = $all;
		$counts['created'] = $created;
		$counts['updated'] = $updated;
		$counts['duplicates'] = $all - $unique;
	
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
}