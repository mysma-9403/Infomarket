<?php

namespace AppBundle\Factory\Admin\Import\Product;

use AppBundle\Factory\Admin\ErrorFactory;

class ImportErrorFactory extends ErrorFactory {

	public function createInvalidCategoryError($expectedName, $givenName) {
		$errorMsg = $this->translator->trans('error.importRatings.category.invalid');
		
		$errorMsg = str_replace('%expectedName%', '<strong>' . $expectedName . '</strong>', $errorMsg);
		$errorMsg = str_replace('%givenName%', '<strong>' . $givenName . '</strong>', $errorMsg);
		
		return $errorMsg;
	}

	public function createColumnNotExistsError($name) {
		$errorMsg = $this->translator->trans('error.importRatings.column.notExists');
		
		$errorMsg = str_replace('%name%', $name, $errorMsg);
		
		return $errorMsg;
	}

	public function createColumnDuplicateError($name, $currIndex, $prevIndex) {
		$errorMsg = $this->translator->trans('error.importRatings.column.duplicate');
		
		$errorMsg = str_replace('%name%', $name, $errorMsg);
		$errorMsg = str_replace('%prevIndex%', $prevIndex, $errorMsg);
		$errorMsg = str_replace('%currIndex%', $currIndex, $errorMsg);
		
		return $errorMsg;
	}

	public function createNotExistsError($lineNumber, $entryType, $entryName, $entrySubname = null) {
		$lineMsg = $this->createLineError($lineNumber);
		
		$errorMsg = $this->translator->trans('error.importRatings.' . $entryType . '.notExists');
		$errorMsg = str_replace('%name%', $entryName, $errorMsg);
		if ($entrySubname)
			$errorMsg = str_replace('%subname%', $entrySubname, $errorMsg);
		else
			$errorMsg = str_replace(' %subname%', '', $errorMsg);
		
		return $lineMsg . $errorMsg;
	}

	public function createEmptyError($lineNumber, $entryType) {
		$lineMsg = $this->createLineError($lineNumber);
		
		$errorMsg = $this->translator->trans('error.importRatings.' . $entryType . '.empty');
		
		return $lineMsg . $errorMsg;
	}

	public function createInconsistentDataError($prevNumber, $nextNumber, $brandName, $productName) {
		$lineMsg = $this->createLinesError($prevNumber, $nextNumber);
		
		$errorMsg = $this->translator->trans('error.importRatings.product.inconsistentData');
		$errorMsg = str_replace('%brandName%', $brandName, $errorMsg);
		$errorMsg = str_replace('%productName%', $productName, $errorMsg);
		
		return $lineMsg . $errorMsg;
	}

	public function createSameCategoryError($prevNumber, $nextNumber, $brandName, $productName, $categoryName, 
			$categorySubname) {
		$lineMsg = $this->createLinesError($prevNumber, $nextNumber);
		
		$errorMsg = $this->translator->trans('error.importRatings.product.sameCategory');
		$errorMsg = str_replace('%brandName%', $brandName, $errorMsg);
		$errorMsg = str_replace('%productName%', $productName, $errorMsg);
		$errorMsg = str_replace('%categoryName%', $categoryName, $errorMsg);
		if (strlen($categorySubname) > 0)
			$errorMsg = str_replace('%categorySubname%', $categorySubname, $errorMsg);
		else
			$errorMsg = str_replace(' %categorySubname%', '', $errorMsg);
		
		return $lineMsg . $errorMsg;
	}
}