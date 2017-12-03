<?php

namespace AppBundle\Logic\Admin\Import\Common;

class CountManager {

	/**
	 *
	 * @param array $entries
	 *        	$param string $key entry key (e.g. product)
	 */
	public function getCounts(array $entries, $key) {
		$counts = array();
		
		$all = 0;
		$created = 0;
		$updated = 0;
		$duplicated = 0;
		
		foreach ($entries as $entry) {
			$all ++;
			
			if ($entry[$key . 'ForUpdate']) {
				$item = $entry[$key];
				if ($item->getId() <= 0) {
					$created ++;
				} else {
					$updated ++;
				}
			} else {
				$item = $entry[$key];
				if ($item->getId() <= 0) {
					$duplicated ++;
				}
			}
		}
		
		$counts['all'] = $all;
		$counts['created'] = $created;
		$counts['updated'] = $updated;
		$counts['duplicated'] = $duplicated;
		
		return $counts;
	}
}