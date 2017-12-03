<?php

namespace AppBundle\Manager\Transaction\Base;

use AppBundle\Manager\Persistence\Base\PersistenceManager;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class TransactionManager {

	/**
	 *
	 * @var ObjectManager
	 */
	protected $em;

	/**
	 *
	 * @var PersistenceManager
	 */
	protected $persistenceManager;

	public function __construct(ObjectManager $em, PersistenceManager $persistenceManager) {
		$this->em = $em;
		$this->persistenceManager = $persistenceManager;
	}

	public function saveItem(Request $request, $item, array $params) {
		$this->em->getConnection()->beginTransaction();
		try {
			$this->persistenceManager->saveItem($request, $item, $params);
			$this->em->getConnection()->commit();
		} catch (\Exception $ex) {
			$this->em->getConnection()->rollBack();
			$this->em->clear();
			throw $ex;
		}
	}

	public function deleteItem(Request $request, $item, array $params) {
		$this->em->getConnection()->beginTransaction();
		try {
			$this->persistenceManager->deleteItem($request, $item, $params);
			$this->em->getConnection()->commit();
		} catch (\Exception $ex) {
			$this->em->getConnection()->rollBack();
			$this->em->clear();
			throw $ex;
		}
	}

	public function deleteItems(Request $request, array $items, array $params) {
		$this->em->getConnection()->beginTransaction();
		try {
			$this->persistenceManager->deleteItems($request, $items, $params);
			$this->em->getConnection()->commit();
		} catch (\Exception $ex) {
			$this->em->getConnection()->rollBack();
			$this->em->clear();
			throw $ex;
		}
	}
}