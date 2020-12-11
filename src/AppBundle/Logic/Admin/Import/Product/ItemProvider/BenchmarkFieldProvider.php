<?php

namespace AppBundle\Logic\Admin\Import\Product\ItemProvider;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\Category;
use AppBundle\Logic\Admin\Import\Common\ItemProvider;
use AppBundle\Logic\Admin\Import\Common\PersistenceManager;

class BenchmarkFieldProvider extends ItemProvider {

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::getSearchCriteria()
	 */
	protected function getSearchCriteria(Category $category, array $entry) {
		$fieldNumber = $entry['fieldNumber'];
		
		return ['category' => $category, 'fieldNumber' => $fieldNumber];
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::updateItem()
	 *
	 * @param BenchmarkField $item        	
	 */
	public function updatePersistentItem(&$item, array $entry) {
		$forUpdate = false;
		
		$fieldName = $entry['fieldName'];
		if ($item->getFieldName() != $fieldName) {
			$item->setFieldName($fieldName);
			$forUpdate = true;
		}
		
		$valueNumber = $entry['valueNumber'];
		if ($item->getValueNumber() != $valueNumber) {
			$item->getValueNumber($valueNumber);
			$forUpdate = true;
		}
		
		$fieldType = $entry['fieldType'];
		if ($item->getFieldType() != $fieldType) {
			$item->setFieldType($fieldType);
			$forUpdate = true;
			
			if ($entry['fieldType'] == BenchmarkField::DECIMAL_FIELD_TYPE) {
				$item->setDecimalPlaces(2);
			} else {
				$item->setDecimalPlaces(0);
			}
		}
		
		$showField = $entry['showField'];
		if ($item->getShowField() != $showField) {
			$item->setShowField($showField);
			$forUpdate = true;
		}
		
		$filterName = $entry['filterName'];
		if ($item->getFilterName() != $filterName) {
			$item->setFilterName($filterName);
			$forUpdate = true;
		}
		
		$filterNumber = $entry['filterNumber'];
		if ($item->getFilterNumber() != $filterNumber) {
			$item->setFilterNumber($filterNumber);
			$forUpdate = true;
		}
		
		$showFilter = $entry['showFilter'];
		if ($item->getShowFilter() != $showFilter) {
			$item->setShowFilter($showFilter);
			$forUpdate = true;
		}
		
		return $forUpdate;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Admin\Import\Common\PersistenceManager::createItem()
	 *
	 * @param BenchmarkField $item        	
	 */
	public function createNewItem(Category $category, array $entry) {
		$item = new BenchmarkField();
		
		$item->setCategory($category);
		
		$item->setFieldType($entry['fieldType']);
		$item->setValueNumber($entry['valueNumber']);
		
		$item->setFieldName($entry['fieldName']);
		$item->setFieldNumber($entry['fieldNumber']);
		$item->setShowField($entry['showField']);
		
		$item->setFilterName($entry['filterName']);
		$item->setFilterNumber($entry['filterNumber']);
		$item->setShowFilter($entry['showFilter']);
		
		if ($entry['fieldType'] == BenchmarkField::DECIMAL_FIELD_TYPE) {
			$item->setDecimalPlaces(2);
		} else {
			$item->setDecimalPlaces(0);
		}
		
		return $item;
	}
}