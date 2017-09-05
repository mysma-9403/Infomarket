<?php

namespace AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;

abstract class BenchmarkFieldFactoryBase implements BenchmarkFieldFactory {

	/**
	 *
	 * @var BenchmarkFieldDataBaseUtils
	 */
	protected $benchmarkFieldDataBaseUtils;

	public function __construct(BenchmarkFieldDataBaseUtils $benchmarkFieldDataBaseUtils) {
		$this->benchmarkFieldDataBaseUtils = $benchmarkFieldDataBaseUtils;
	}

	protected function initValueFieldProperty($field) {
		$field['valueField'] = $this->benchmarkFieldDataBaseUtils->getValueFieldProperty($field['fieldType'], 
				$field['valueNumber']);
		
		return $field;
	}

	protected function initNoteFieldProperty($field) {
		$field['noteField'] = $this->benchmarkFieldDataBaseUtils->getNoteFieldProperty($field['fieldType'], 
				$field['valueNumber']);
		
		return $field;
	}

	protected function initModeProperty($field) {
		$valueField = $field['valueField'];
		$valueCounts = $field['counts'];
		$maxCount = null;
		$mode = null;
		
		foreach ($valueCounts as $valueCount) {
			$count = $valueCount['vcount'];
			if ($count > $maxCount) {
				$maxCount = $count;
				$mode = $valueCount[$valueField];
			}
		}
		$field['mode'] = $mode;
		
		return $field;
	}
}