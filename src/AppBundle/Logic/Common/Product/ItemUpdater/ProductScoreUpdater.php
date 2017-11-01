<?php

namespace AppBundle\Logic\Common\Product\ItemUpdater;

use AppBundle\Entity\Main\BenchmarkEnum;
use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Other\ProductScore;
use Doctrine\Common\Persistence\ObjectManager;

class ProductScoreUpdater implements ItemUpdater {

	/**
	 *
	 * @var ObjectManager
	 */
	private $em;

	public function __construct(ObjectManager $em) {
		$this->em = $em;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Common\Product\ItemUpdater\ItemUpdater::update()
	 *
	 * @param ProductScore $item        	
	 */
	public function update($item) {
		$productValue = $item->getProductCategoryAssignment()->getProductValue();
		$benchmarkFields = $item->getProductCategoryAssignment()->getCategory()->getBenchmarkFields();
		
		/** @var BenchmarkField $benchmarkField */
		foreach ($benchmarkFields as $benchmarkField) {
			if ($this->isEnum($benchmarkField)) {
				$offset = $benchmarkField->getValueNumber();
				$value = $productValue->offsetGet('string' . $offset);
				$score = $this->calculateScore($benchmarkField, $value);
				$item->offsetSet('stringScore' . $offset, $score);
			}
		}
		
		$item->setUpToDate(true);
		
		$this->em->persist($item);
	}

	private function calculateScore(BenchmarkField $benchmarkField, $value) {
		$score = 0;
		
		if ($this->isEnum($benchmarkField)) {
			
			if (strlen($value) > 0) {
				$values = explode(",", $value);
				$values = array_map('trim', $values);
				
				/** @var BenchmarkEnum $benchmarkEnum */
				foreach ($benchmarkField->getBenchmarkEnums() as $benchmarkEnum) {
					if (in_array($benchmarkEnum->getName(), $values)) {
						$score += $benchmarkEnum->getValue();
					}
				}
			}
		}
		
		return $score;
	}

	private function isEnum(BenchmarkField $benchmarkField) {
		return $benchmarkField->getFieldType() == BenchmarkField::SINGLE_ENUM_FIELD_TYPE ||
				 $benchmarkField->getFieldType() == BenchmarkField::MULTI_ENUM_FIELD_TYPE;
	}
}