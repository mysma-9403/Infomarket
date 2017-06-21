<?php

namespace AppBundle\Logic\Benchmark\Export;

use AppBundle\Entity\BenchmarkField;

class ExcelExportLogic {
	
	protected $headerCellWidth = 52;
	
	protected $imageCellWidth = 24;
	protected $imageCellHeight = 120;
	
	protected $maxImageWidth = 172;
	protected $maxImageHeight = 160;
	
	protected $imageMarginX = 12;
	protected $imageMarginY = 12;
	
	public function export($entryFilter, $entries) {
		$excel = $this->createExcel();
		
		$this->fillProperties($excel);
		$this->fillContent($excel, $entries, $entryFilter);	
		
		$this->save($excel);
	}
	
	protected function createExcel() {
		return new \PHPExcel();
	}
	
	protected function fillProperties(&$excel) {
		
		$date = new \DateTime();
		
		$excel->getProperties()
		->setCreator("Infomarket")
		->setLastModifiedBy("Infomarket")
		->setTitle($date->format('Y-m-d') . " - benchmark")
		->setSubject("InfoMarket - Benchmark")
		->setDescription("InfoMarket - Benchmark")
		->setKeywords("InfoMarket benchmark products");
	}
	
	protected function fillContent($excel, $entries, $entryFilter) {
		if(count($entries) > 0) {
			$this->fillEntriesContent($excel, $entries, $entryFilter);
		} else {
			$this->fillEmptyContent($excel);
		}
	}
	
	protected function fillEntriesContent(&$excel, $entries, $entryFilter) {
		$sheet = $excel->getActiveSheet();
		
		$sheet->getRowDimension(1)->setRowHeight($this->imageCellHeight);
		$sheet->getColumnDimensionByColumn(0)->setWidth($this->headerCellWidth);
		
		$this->hideEmptyFilterFields($entries, $entryFilter);
		
		$this->fillHeaderFields($sheet, $entryFilter);
		
		$col = 1;
		foreach ($entries as $entry) {
			$sheet->getColumnDimensionByColumn($col)->setWidth($this->imageCellWidth);
			$this->fillEntryFields($sheet, $col++, $entry, $entryFilter);
		}
	}
	
	protected function fillHeaderFields($sheet, $entryFilter) {
		$row = 2;
		$this->fillHeaderField($sheet, $row++, 'Marka');
		$this->fillHeaderField($sheet, $row++, 'Symbol');
		
		foreach ($entryFilter->getShowFields() as $showField) {
			if(!$showField['hidden']) {
				$this->fillHeaderField($sheet, $row++, $showField['fieldName']);
			}
		}
	}
	
	protected function fillHeaderField($sheet, $row, $value) {
		$cell = $sheet->getCellByColumnAndRow(0, $row);
		
		$cell->setValue($value);
		
		$cell->getStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$cell->getStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);
		$cell->getStyle()->getAlignment()->setWrapText(true);
		
		$cell->getStyle()->getFont()->setBold(true);
	}
	
	protected function fillEntryFields($sheet, $col, $entry, $entryFilter) {
		$row = 1;
		$this->fillImageField($sheet, $col, $row++, $entry['image']);
		$this->fillValueField($sheet, $col, $row++, $entry['brandName'], true);
		$this->fillValueField($sheet, $col, $row++, $entry['name'], true);
			
		foreach ($entryFilter->getShowFields() as $showField) {
			if(!$showField['hidden']) {
				$value = $this->getFieldValue($entry, $showField);
				$this->fillValueField($sheet, $col, $row++, $value);
			}
		}
	}
	
	protected function fillImageField($sheet, $col, $row, $image) {
		$cell = $sheet->getCellByColumnAndRow($col, $row);
		
		if($image && file_exists($image)) {
			$drawing = new \PHPExcel_Worksheet_Drawing();
			$drawing->setPath($image);
			$drawing->setCoordinates($cell->getCoordinate());
			$drawing->setWorksheet($sheet);
			$drawing->setResizeProportional(true);
		
			if($drawing->getWidth() >= $drawing->getHeight()) {
				$drawing->setWidth($this->maxImageWidth - 2*$this->imageMarginX);
				$drawing->setOffsetX($this->imageMarginX);
				$drawing->setOffsetY(($this->maxImageHeight - $drawing->getHeight()) / 2);
			} else {
				$drawing->setHeight($this->maxImageHeight - 2*$this->imageMarginY);
				$drawing->setOffsetY($this->imageMarginY);
				$drawing->setOffsetX(($this->maxImageWidth - $drawing->getWidth()) / 2);
			}
		}
	}
	
	protected function fillValueField($sheet, $col, $row, $value, $bold = false) {
		$cell = $sheet->getCellByColumnAndRow($col, $row);
		
		$cell->setValue($value);
		
		$cell->getStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$cell->getStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);
		$cell->getStyle()->getAlignment()->setWrapText(true);
		
		if($bold) $cell->getStyle()->getFont()->setBold(true);
	}
	
	protected function hideEmptyFilterFields($entries, &$entryFilter) {
		$showFields = $entryFilter->getShowFields();
		foreach ($showFields as $key => $showField) {
			$hidden = true;
			foreach($entries as $entry) {
				$value = $this->getFieldValue($entry, $showField);
				if($value) {
					$hidden = false;
					break;
				}
			}
			$showField['hidden'] = $hidden;				
			$showFields[$key] = $showField;
		}
		$entryFilter->setShowFields($showFields);
	}
	
	//TODO should be somewhere else
	protected function getFieldValue($entry, $showField) {
		$valueField = $showField['valueField'];
		
		switch($showField['fieldType']) {
			case BenchmarkField::BOOLEAN_FIELD_TYPE:
				return $entry[$valueField] ? "+" : "-";
			default:
				return $entry[$valueField];
		}
	}
	
	protected function fillEmptyContent(&$excel) {
		$excel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "No entries found.");
	}
	
	protected function save($excel) {
		$writer = new \PHPExcel_Writer_Excel2007($excel);
		$writer->setOffice2003Compatibility(true);
		$writer->save('php://output');
	}
}