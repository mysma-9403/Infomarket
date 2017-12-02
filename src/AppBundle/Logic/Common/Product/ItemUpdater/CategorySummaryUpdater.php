<?php

namespace AppBundle\Logic\Common\Product\ItemUpdater;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Other\CategorySummary;
use AppBundle\Logic\Common\BenchmarkField\Distribution\DistributionCalculator;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Logic\Common\BenchmarkField\Distribution\ScoreDistributionCalculator;

class CategorySummaryUpdater implements ItemUpdater {

	/**
	 *
	 * @var ObjectManager
	 */
	private $em;

	/**
	 *
	 * @var BenchmarkFieldDataBaseUtils
	 */
	private $benchmarkFieldDataBaseUtils;

	/**
	 *
	 * @var DistributionCalculator
	 */
	private $distributionCalculator;

	/**
	 *
	 * @var ScoreDistributionCalculator
	 */
	private $scoreDistributionCalculator;

	public function __construct(ObjectManager $em, BenchmarkFieldDataBaseUtils $benchmarkFieldDataBaseUtils, 
			DistributionCalculator $distributionCalculator, 
			ScoreDistributionCalculator $scoreDistributionCalculator) {
		$this->em = $em;
		$this->benchmarkFieldDataBaseUtils = $benchmarkFieldDataBaseUtils;
		$this->distributionCalculator = $distributionCalculator;
		$this->scoreDistributionCalculator = $scoreDistributionCalculator;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Common\Product\ItemUpdater\ItemUpdater::update()
	 *
	 * @param CategorySummary $item        	
	 */
	public function update($item) {
		$item = $this->updateSummary($item);
		$item->setUpToDate(true);
		
		$this->em->persist($item);
	}

	private function updateSummary(CategorySummary $item) {
		/** @var BenchmarkField $field */
		foreach ($item->getCategory()->getBenchmarkFields() as $field) {
			if ($this->isNumberField($field)) {
				$distribution = $this->distributionCalculator->calculate($field);
				
				$item = $this->updateFieldMin($item, $field, $this->calculateMin($distribution));
				$item = $this->updateFieldMax($item, $field, $this->calculateMax($distribution));
				$item = $this->updateFieldMedian($item, $field, $this->calculateMedian($distribution));
				$item = $this->updateFieldMode($item, $field, $this->calculateMode($distribution));
				$item = $this->updateFieldMean($item, $field, $this->calculateMean($distribution));
			} else if ($this->isEnumField($field)) {
				$distribution = $this->scoreDistributionCalculator->calculate($field);
				
				$item = $this->updateFieldMin($item, $field, $this->calculateMin($distribution));
				$item = $this->updateFieldMax($item, $field, $this->calculateMax($distribution));
			}
		}
		
		return $item;
	}

	private function isNumberField(BenchmarkField $field) {
		return $field->getFieldType() == BenchmarkField::INTEGER_FIELD_TYPE ||
				 $field->getFieldType() == BenchmarkField::DECIMAL_FIELD_TYPE;
	}

	private function isEnumField(BenchmarkField $field) {
		return $field->getFieldType() == BenchmarkField::SINGLE_ENUM_FIELD_TYPE ||
				 $field->getFieldType() == BenchmarkField::MULTI_ENUM_FIELD_TYPE;
	}

	private function updateFieldMin(CategorySummary $item, BenchmarkField $field, $value) {
		$offset = $this->benchmarkFieldDataBaseUtils->getMinField($field);
		$item->offsetSet($offset, $value);
		
		return $item;
	}

	private function updateFieldMax(CategorySummary $item, BenchmarkField $field, $value) {
		$offset = $this->benchmarkFieldDataBaseUtils->getMaxField($field);
		$item->offsetSet($offset, $value);
		
		return $item;
	}

	private function updateFieldMedian(CategorySummary $item, BenchmarkField $field, $value) {
		$offset = $this->benchmarkFieldDataBaseUtils->getMedianField($field);
		$item->offsetSet($offset, $value);
		
		return $item;
	}

	private function updateFieldMode(CategorySummary $item, BenchmarkField $field, $value) {
		$offset = $this->benchmarkFieldDataBaseUtils->getModeField($field);
		$item->offsetSet($offset, $value);
		
		return $item;
	}

	private function updateFieldMean(CategorySummary $item, BenchmarkField $field, $value) {
		$offset = $this->benchmarkFieldDataBaseUtils->getMeanField($field);
		$item->offsetSet($offset, $value);
		
		return $item;
	}

	private function calculateMin(array $distribution) {
		$min = PHP_INT_MAX;
		
		foreach (array_keys($distribution) as $value) {
			if ($min > $value) {
				$min = $value;
			}
		}
		
		return $min;
	}

	private function calculateMax(array $distribution) {
		$max = PHP_INT_MIN;
		
		foreach (array_keys($distribution) as $value) {
			if ($max < $value) {
				$max = $value;
			}
		}
		
		return $max;
	}

	private function calculateMedian(array $distribution) {
		$index = $this->calculateSum($distribution) / 2;
		$current = 0;
		
		foreach ($distribution as $key => $value) {
			$current += $value;
			if ($current >= $index) {
				return $key;
			}
		}
		
		return null;
	}

	private function calculateMode(array $distribution) {
		$maxCount = - 1;
		$mode = - 1;
		
		foreach ($distribution as $key => $value) {
			if ($maxCount < $value) {
				$maxCount = $value;
				$mode = $key;
			}
		}
		
		return $mode;
	}

	private function calculateMean(array $distribution) {
		$nom = 0;
		$denom = 0;
		
		foreach ($distribution as $key => $value) {
			$nom += $key * $value;
			$denom += $value;
		}
		
		return $denom ? $nom / $denom : null;
	}

	private function calculateSum(array $distribution) {
		$sum = 0;
		
		foreach ($distribution as $value) {
			$sum += $value;
		}
		
		return $sum;
	}
}