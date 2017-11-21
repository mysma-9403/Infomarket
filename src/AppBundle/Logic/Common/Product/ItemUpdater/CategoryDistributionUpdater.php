<?php

namespace AppBundle\Logic\Common\Product\ItemUpdater;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Other\CategoryDistribution;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Main\Category;

class CategoryDistributionUpdater implements ItemUpdater {

	/**
	 *
	 * @var ObjectManager
	 */
	protected $em;

	/**
	 *
	 * @var BenchmarkFieldDataBaseUtils
	 */
	protected $benchmarkFieldDataBaseUtils;

	public function __construct(ObjectManager $em, BenchmarkFieldDataBaseUtils $benchmarkFieldDataBaseUtils) {
		$this->em = $em;
		$this->benchmarkFieldDataBaseUtils = $benchmarkFieldDataBaseUtils;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Common\Product\ItemUpdater\ItemUpdater::update()
	 *
	 * @param CategoryDistribution $item        	
	 */
	public function update($item) {
		$item = $this->updateDistribution($item);
		$item->setUpToDate(true);
		
		$this->em->persist($item);
	}

	private function updateDistribution(CategoryDistribution $item) {
		/** @var BenchmarkField $field */
		foreach ($item->getCategory()->getBenchmarkFields() as $field) {
			$distribution = $this->calculateFieldDistribution($item, $field);
			
			$item = $this->updateFieldDistribution($item, $field, $distribution);
			if ($this->isNumberField($field)) {
				$item = $this->updateFieldMean($item, $field, $distribution);
				$item = $this->updateFieldMode($item, $field, $distribution);
				$item = $this->updateFieldMedian($item, $field, $distribution);
			}
		}
		
		return $item;
	}

	private function isNumberField(BenchmarkField $field) {
		return $field->getFieldType() == BenchmarkField::INTEGER_FIELD_TYPE ||
				 $field->getFieldType() == BenchmarkField::DECIMAL_FIELD_TYPE;
	}

	private function calculateFieldDistribution(CategoryDistribution $item, BenchmarkField $field) {
		$category = $item->getCategory();
		$result = $this->calculateCategoryFieldDistribution($category, $field);
		
		/** @var Category $subcategory */
		foreach ($category->getChildren() as $subcategory) {
			if ($subcategory->getBenchmark()) {
				$subresult = $this->calculateCategoryFieldDistribution($subcategory, $field);
				$result = $this->mergeResults($result, $subresult);
			}
		}
		
		ksort($result);
		return $result;
	}

	private function calculateCategoryFieldDistribution(Category $category, BenchmarkField $field) {
		$result = [];
		
		/** @var ProductCategoryAssignment $assignment */
		foreach ($category->getProductCategoryAssignments() as $assignment) {
			$productValue = $assignment->getProductValue();
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
		
		return $result;
	}

	private function updateFieldDistribution(CategoryDistribution $item, BenchmarkField $field, 
			array $distribution) {
		$offset = $this->benchmarkFieldDataBaseUtils->getDistributionField($field);
		$value = $this->getDistributionString($distribution);
		$item->offsetSet($offset, $value);
		
		return $item;
	}

	private function getDistributionString(array $distribution) {
		$pairs = [];
		
		foreach ($distribution as $key => $value) {
			$pairs[] = join(":", [$key, $value]);
		}
		
		return join(";", $pairs);
	}

	function updateFieldMean(CategoryDistribution $item, BenchmarkField $field, array $distribution) {
		$offset = $this->benchmarkFieldDataBaseUtils->getMeanField($field);
		$value = $this->getMean($distribution);
		$item->offsetSet($offset, $value);
		
		return $item;
	}

	private function getMean(array $distribution) {
		$nom = 0;
		$denom = 0;
		
		foreach ($distribution as $key => $value) {
			$nom += $key * $value;
			$denom += $value;
		}
		
		return $denom ? $nom / $denom : null;
	}

	private function updateFieldMode(CategoryDistribution $item, BenchmarkField $field, array $distribution) {
		$offset = $this->benchmarkFieldDataBaseUtils->getModeField($field);
		$value = $this->getMode($distribution);
		$item->offsetSet($offset, $value);
		
		return $item;
	}

	private function getMode(array $distribution) {
		$maxCount = 0;
		$mode = 0;
		
		foreach ($distribution as $key => $value) {
			if ($maxCount < $value) {
				$maxCount = $value;
				$mode = $key;
			}
		}
		
		return $mode;
	}

	private function updateFieldMedian(CategoryDistribution $item, BenchmarkField $field, array $distribution) {
		$offset = $this->benchmarkFieldDataBaseUtils->getMedianField($field);
		$value = $this->getMedian($distribution);
		$item->offsetSet($offset, $value);
		
		return $item;
	}

	private function getMedian(array $distribution) {
		$index = $this->getSum($distribution) / 2;
		$current = 0;
		
		foreach ($distribution as $key => $value) {
			$current += $value;
			if ($current <= $index) {
				return $key;
			}
		}
		
		return null;
	}

	private function getSum(array $distribution) {
		$sum = 0;
		
		foreach ($distribution as $value) {
			$sum += $value;
		}
		
		return $sum;
	}

	private function mergeResults(array $result, array $subresult) {
		foreach ($subresult as $key => $value) {
			if (array_key_exists($key, $result)) {
				$result[$key] = $result[$key] + $value;
			} else {
				$result[$key] = $value;
			}
		}
		return $result;
	}
}