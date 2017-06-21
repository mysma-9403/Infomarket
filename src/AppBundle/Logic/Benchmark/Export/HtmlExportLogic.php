<?php

namespace AppBundle\Logic\Benchmark\Export;

use AppBundle\Entity\BenchmarkField;

class HtmlExportLogic {
	
	public function export($entryFilter, $entries) {
		$handle = fopen('php://output', 'w+');
			
		$this->fillContent($handle, $entryFilter, $entries);
		
		fclose($handle);
	}
	
	protected function fillContent($handle, $entryFilter, $entries) {
		$date = new \DateTime();
			
		fputs($handle, "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n");
		fputs($handle, "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n");
		fputs($handle, "<head>\n");
		fputs($handle, "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n");
		fputs($handle, "<title>Benchmark " . $date->format('d.m.Y') . "</title>\n");
		fputs($handle, "</head>\n");
		fputs($handle, "<body>\n");
		
		if(count($entries) > 0) {
			$this->fillEntriesContent($handle, $entryFilter, $entries);
		} else {
			$this->fillEmptyContent($handle);
		}
		
		fputs($handle, "</body>\n");
	}
	
	protected function fillEntriesContent($handle, $entryFilter, $entries) {
		
		//TODO generate some template file or sth??
		fputs($handle, "<table>\n");
	
		$this->fillImageRow($handle, $entries, 'image');
		
		$this->fillValueRow($handle, $entries, 'Marka', 'brandName');
		$this->fillValueRow($handle, $entries, 'Symbol', 'name');
	
		foreach ($entryFilter->getShowFields() as $showField) {
			$valueField = $showField['valueField'];
			$label = $showField['fieldName'];
	
			switch($showField['fieldType']) {
				case BenchmarkField::BOOLEAN_FIELD_TYPE:
					$this->fillBooleanRow($handle, $entries, $label, $valueField);
					break;
				default:
					$this->fillValueRow($handle, $entries, $label, $valueField);
					break;
			}
		}
	
		fputs($handle, "</table>\n");
	}
	
	protected function fillImageRow($handle, $entries, $fieldName) {
		$row = "<tr><th width=\"200\" style=\"text-align: right;\"></th>\n";
		$show = false;
		foreach ($entries as $entry) {
			$value = $entry[$fieldName];
			$row .= "<td width=\"200\"><img width=\"100%\" style=\"max-width: 200px;\" src=\"http://infomarket.edu.pl/";
			if($value) {
				$row .= $entry[$fieldName];
				$show = true;
			}
			$row .= "\"></td>\n";
		}
		$row .= "<td></td></tr>\n";
		
		if($show) {
			fputs($handle, $row); 
		}
	}
	
	protected function fillBooleanRow($handle, $entries, $label, $fieldName) {
		$row = "<tr><th style=\"text-align: right;\">" . $label . "</th>\n";
		$show = false;
		foreach ($entries as $entry) {
			$value = $entry[$fieldName];
			$row .= "<td style=\"text-align: center;\">";
			if($value) {
				$row .= $entry[$fieldName] ? "+" : "-";
				$show = true;
			}
			$row .= "</td>\n";
		}
		$row .= "<td></td></tr>\n";
	
		if($show) {
			fputs($handle, $row);
		}
	}
	
	protected function fillValueRow($handle, $entries, $label, $fieldName) {
		$row = "<tr><th style=\"text-align: right;\">" . $label . "</th>\n";
		$show = false;
		foreach ($entries as $entry) {
			$value = $entry[$fieldName];
			$row .= "<td style=\"text-align: center;\">";
			if($value) {
				$row .= $entry[$fieldName];
				$show = true;
			}
			$row .= "</td>\n";
		}
		$row .= "<td></td></tr>\n";
	
		if($show) {
			fputs($handle, $row);
		}
	}
	
	protected function fillEmptyContent($handle) {
		fputs($handle, "No entries found.\n");
	}
}