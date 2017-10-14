<?php

namespace AppBundle\Logic\Admin\Import\Common;



class PersistenceManager {

	protected $em;

	/**
	 * 
	 * @var ItemProvider
	 */
	protected $itemProvider;
	
	/**
	 * 
	 * @var string
	 */
	protected $type;

	public function __construct($doctrine, ItemProvider $itemProvider, $type) {
		$this->em = $doctrine->getManager();
		$this->itemProvider = $itemProvider;
		$this->type = $type;
	}

	public function getUpdatedEntries($entries) {
		$count = count($entries);
		for ($i = 0; $i < $count; $i ++) {
			$entry = $entries[$i];
			
			$item = $this->itemProvider->getPersistentItem($entry);
				
			if ($item) {
				$forUpdate = $this->itemProvider->updatePersistentItem($item, $entry);
				$entry[$this->type . 'ForUpdate'] = $forUpdate;
			} else {
				$item = $this->itemProvider->createNewItem($entry);
				$entry[$this->type . 'ForUpdate'] = true;
			}
				
			$entry[$this->type] = $item;
				
			$entries[$i] = $entry;
		}
	
		return $entries;
	}
	
	/**
	 *
	 * @param array $entries        	
	 * @param string $key
	 *        	entry key (e.g. product)
	 */
	public function saveEntries(array $entries) {
		$connection = $this->em->getConnection();
		$connection->beginTransaction();
		try {
			foreach ($entries as $entry) {
				$this->saveEntry($entry);
			}
			$this->em->flush();
			$connection->commit();
		} catch (Exception $ex) {
			$connection->rollback();
			throw $ex;
		}
	}
	
	protected function saveEntry($entry) {
		if ($entry[$this->type . 'ForUpdate']) {
			$item = $entry[$this->type];
			$this->em->persist($item);
			$entry[$this->type] = $item;
		}
	}
}