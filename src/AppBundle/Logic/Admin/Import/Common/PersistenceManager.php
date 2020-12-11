<?php

namespace AppBundle\Logic\Admin\Import\Common;

use AppBundle\Entity\Main\Category;

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

	public function getUpdatedEntries(Category $category, array $entries) {
		foreach ($entries as $key => $entry) {
			$entries[$key] = $this->getUpdatedEntry($category, $entry);
		}
		return $entries;
	}

	protected function getUpdatedEntry(Category $category, $entry) {
		$item = $this->itemProvider->getPersistentItem($category, $entry);
		
		if ($item) {
			$forUpdate = $this->itemProvider->updatePersistentItem($item, $entry);
			$entry[$this->type . 'ForUpdate'] = $forUpdate;
		} else {
			$item = $this->itemProvider->createNewItem($category, $entry);
			$entry[$this->type . 'ForUpdate'] = true;
		}
		
		$entry[$this->type] = $item;
		
		return $entry;
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