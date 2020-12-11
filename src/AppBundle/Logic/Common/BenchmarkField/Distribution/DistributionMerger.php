<?php

namespace AppBundle\Logic\Common\BenchmarkField\Distribution;

class DistributionMerger {
	
	public function merge(array $mergeTo, array $mergeFrom) {
		foreach ($mergeFrom as $key => $value) {
			if (array_key_exists($key, $mergeTo)) {
				$mergeTo[$key] = $mergeTo[$key] + $value;
			} else {
				$mergeTo[$key] = $value;
			}
		}
		return $mergeTo;
	}
}