<?php

namespace AppBundle\Logic\Common\BenchmarkField\Distribution;

use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;

class DistributionCalculator {

	/**
	 *
	 * @var BenchmarkFieldDataBaseUtils
	 */
	private $benchmarkFieldDataBaseUtils;

	/**
	 *
	 * @var DistributionMerger
	 */
	private $distributionMerger;

	public function __construct(BenchmarkFieldDataBaseUtils $benchmarkFieldDataBaseUtils, 
			DistributionMerger $distributionMerger) {
		$this->benchmarkFieldDataBaseUtils = $benchmarkFieldDataBaseUtils;
		$this->distributionMerger = $distributionMerger;
	}

	public function calculate(BenchmarkField $field) {
		$category = $field->getCategory();
		
		$result = $this->calculateForCategory($category, $field);
		
		/** @var Category $subcategory */
		foreach ($category->getChildren() as $subcategory) {
			if ($subcategory->getBenchmark()) {
				$subresult = $this->calculateForCategory($subcategory, $field);
				$result = $this->distributionMerger->merge($result, $subresult);
			}
		}
		
		ksort($result);
		return $result;
	}

	private function calculateForCategory(Category $category, BenchmarkField $field) {
		$result = [];
		
		/** @var ProductCategoryAssignment $assignment */
		foreach ($category->getProductCategoryAssignments() as $assignment) {
			$productValue = $assignment->getProductValue();
			if ($productValue) {
				$offset = $this->benchmarkFieldDataBaseUtils->getValueField($field);
				$value = $productValue->offsetGet($offset);
				
				if ($value !== null) {
					if ($field->getFieldType() == BenchmarkField::MULTI_ENUM_FIELD_TYPE) {
						$enums = explode(",", $value);
						$enums = array_filter($enums, 'trim');
						foreach ($enums as $enum) {
							if (key_exists($enum, $result)) {
								$result[$enum] = $result[$enum] + 1;
							} else {
								$result[$enum] = 1;
							}
						}
					} else {
						if (key_exists($value, $result)) {
							$result[$value] = $result[$value] + 1;
						} else {
							$result[$value] = 1;
						}
					}
				}
			}
		}
		
		return $result;
	}
}