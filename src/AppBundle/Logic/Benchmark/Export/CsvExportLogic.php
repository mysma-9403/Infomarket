<?php

namespace AppBundle\Logic\Benchmark\Export;

use AppBundle\Entity\BenchmarkField;

class CsvExportLogic {
	
	public function export($entryFilter, $entries) {
		$handle = fopen('php://output', 'w+');
			
		$this->fillContent($handle, $entryFilter, $entries);
		
		fclose($handle);
	}
	
	protected function fillContent($handle, $entryFilter, $entries) {
		if(count($entries) > 0) {
			$this->fillEntriesContent($handle, $entryFilter, $entries);
		} else {
			$this->fillEmptyContent($handle);
		}
	}
	
	protected function fillEntriesContent($handle, $entryFilter, $entries) {
		
		$this->fillRow($handle, $entries, 'Marka', 'brandName');
		$this->fillRow($handle, $entries, 'Symbol', 'name');
		$this->fillRow($handle, $entries, '', 'image', 'http://infomarket.edu.pl/');
	
		foreach ($entryFilter->getShowFields() as $showField) {
			$label = $showField['fieldName'];
			$valueField = $showField['valueField'];
			$this->fillRow($handle, $entries, $label, $valueField);
		}
	}
	
	protected function fillRow($handle, $entries, $label, $fieldName, $valuePrefix = null) {
		$fields = array();
		$show = false;
		foreach ($entries as $entry) {
			$value = $entry[$fieldName];
			if($value) {
				if($valuePrefix) {
					$fields[] = $valuePrefix . $value;
				} else {
					$fields[] = $value;
				}
				$show = true;
			} else {
				$fields[] = '';
			}
		}
		
		if($show) {
			$fields = array_merge([$label], $fields);
			fputs($handle, implode($fields, ';') . "\n");
		}
	}
	
	protected function fillEmptyContent($handle) {
		fputcsv($handle, array('No entries found.'), ';');
	}
}