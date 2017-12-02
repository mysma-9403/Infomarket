<?php

namespace AppBundle\Logic\Common\BenchmarkField\Distribution;

use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\Category;

class ScoreDistributionCalculator {
	
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
			$productScore = $assignment->getProductScore();
			$offset = $this->benchmarkFieldDataBaseUtils->getScoreField($field);
			$value = $productScore->offsetGet($offset);
				
			if ($value !== null) {
				if (key_exists($value, $result)) {
					$result[$value] = $result[$value] + 1;
				} else {
					$result[$value] = 1;
				}
			}
		}
	
		return $result;
	}
}