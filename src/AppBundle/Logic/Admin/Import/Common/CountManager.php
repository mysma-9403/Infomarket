<?php

namespace AppBundle\Logic\Admin\Import\Common;

class CountManager {

	/**
	 *
	 * @param array $dataBaseEntries
	 *        	$param string $key entry key (e.g. product)
	 */
	public function getCounts(array $dataBaseEntries, $key) {
		$counts = array();
		
		$all = 0;
		$created = 0;
		$updated = 0;
		$duplicated = 0;
		
		foreach ($dataBaseEntries as $dataBaseEntry) {
			$all ++;
			
			if ($dataBaseEntry[$key . 'ForUpdate']) {
				$product = $dataBaseEntry[$key];
				if ($product->getId() <= 0) {
					$created ++;
				} else {
					$updated ++;
				}
			} else {
				$product = $dataBaseEntry[$key];
				if ($product->getId() <= 0) {
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