<?php

namespace AppBundle\Logic\Admin\Import\Common;

class PersistenceManager {

	protected $em;

	public function __construct($doctrine) {
		$this->em = $doctrine->getManager();
	}

	/**
	 *
	 * @param array $dataBaseEntries        	
	 * @param string $key
	 *        	entry key (e.g. product)
	 */
	public function saveEntries(array $dataBaseEntries, $key) {
		$errors = array();
		
		$connection = $this->em->getConnection();
		$connection->beginTransaction();
		try {
			foreach ($dataBaseEntries as $dataBaseEntry) {
				if ($dataBaseEntry[$key . 'ForUpdate']) {
					$product = $dataBaseEntry[$key];
					$this->em->persist($product);
					$dataBaseEntry[$key] = $product;
				}
			}
			$this->em->flush();
			$connection->commit();
		} catch (Exception $ex) {
			$connection->rollback();
			$errors[] = $ex->getMessage();
		}
		
		return $errors;
	}
}