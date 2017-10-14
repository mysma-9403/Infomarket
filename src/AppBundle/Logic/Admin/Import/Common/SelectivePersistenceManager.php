<?php

namespace AppBundle\Logic\Admin\Import\Common;

use AppBundle\Entity\Main\Category;

abstract class SelectivePersistenceManager extends PersistenceManager {

	public function getUpdatedEntries(Category $category, array $entries) {
		$result = [];
		
		foreach ($entries as $entry) {
			if($this->canUpdate($entry)) {
				$result[] = $this->getUpdatedEntry($category, $entry);
			}
		}
		
		return $result;
	}
	
	protected abstract function canUpdate($entry);
}