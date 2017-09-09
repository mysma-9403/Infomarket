<?php

namespace AppBundle\Entity\Lists;

use Doctrine\Common\Collections\Collection;

class BaseList {

	protected $entries = array();

	/**
	 * Add entry
	 *
	 * @param
	 *        	$entry
	 *        	
	 * @return BaseList
	 */
	public function addEntry($entry) {
		$this->entries[] = $entry;
		
		return $this;
	}

	/**
	 * Remove entry
	 *
	 * @param
	 *        	$entry
	 */
	public function removeEntry($entry) {
		if (($key = array_search($entry, $this->entries)) !== false) {
			unset($this->entries[$key]);
		}
	}

	/**
	 * Get entries
	 *
	 * @return Collection
	 */
	public function getEntries() {
		return $this->entries;
	}
}
