<?php

namespace AppBundle\Logic\Common\Product\ItemUpdater;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Other\CategorySummary;
use AppBundle\Entity\Other\ProductNote;
use Doctrine\Common\Persistence\ObjectManager;

class ProductNoteUpdater implements ItemUpdater {

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
	 * @param ProductNote $item        	
	 */
	public function update($item) {
		$benchmarkFields = $item->getProductCategoryAssignment()->getCategory()->getBenchmarkFields();
		
		$overalNote = 0;
		$count = 0;
		
		/** @var BenchmarkField $benchmarkField */
		foreach ($benchmarkFields as $benchmarkField) {
			if ($benchmarkField->getNoteType() != BenchmarkField::NONE_NOTE_TYPE) {
				$categorySummary = $item->getProductCategoryAssignment()->getCategory()->getCategorySummary();
				$offset = $benchmarkField->getValueNumber();
				
				switch ($benchmarkField->getFieldType()) {
					case BenchmarkField::DECIMAL_FIELD_TYPE:
						$productValue = $item->getProductCategoryAssignment()->getProductValue();
						$min = $categorySummary->offsetGet('decimalMin' . $offset);
						$max = $categorySummary->offsetGet('decimalMax' . $offset);
						$value = $productValue->offsetGet('decimal' . $offset);
						$note = $this->calculateNote($min, $max, $value, $benchmarkField->getNoteType());
						$item->offsetSet('decimalNote' . $offset, $note);
						
						$overalNote += $note * $benchmarkField->getNoteWeight();
						$count += $benchmarkField->getNoteWeight();
						break;
					case BenchmarkField::INTEGER_FIELD_TYPE:
					case BenchmarkField::BOOLEAN_FIELD_TYPE:
						$productValue = $item->getProductCategoryAssignment()->getProductValue();
						$min = $categorySummary->offsetGet('integerMin' . $offset);
						$max = $categorySummary->offsetGet('integerMax' . $offset);
						$value = $productValue->offsetGet('integer' . $offset);
						$note = $this->calculateNote($min, $max, $value, $benchmarkField->getNoteType());
						$item->offsetSet('integerNote' . $offset, $note);
						
						$overalNote += $note * $benchmarkField->getNoteWeight();
						$count += $benchmarkField->getNoteWeight();
						break;
					case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
					case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
						$productScore = $item->getProductCategoryAssignment()->getProductScore();
						$min = $categorySummary->offsetGet('stringMin' . $offset);
						$max = $categorySummary->offsetGet('stringMax' . $offset);
						$value = $productScore->offsetGet('stringScore' . $offset);
						$note = $this->calculateNote($min, $max, $value, $benchmarkField->getNoteType());
						$item->offsetSet('stringNote' . $offset, $note);
						
						$overalNote += $note * $benchmarkField->getNoteWeight();
						$count += $benchmarkField->getNoteWeight();
						break;
					case BenchmarkField::STRING_FIELD_TYPE:
						$item->offsetSet('stringNote' . $offset, 0);
						break;
				}
			}
		}
		
		$item->setOveralNote($count > 0 ? $overalNote / $count : 0);
		$item->setUpToDate(true);
		
		$this->em->persist($item);
	}

	private function calculateNote($min, $max, $value, $noteType) {
		if($value < $min) {
			return $noteType == BenchmarkField::DESC_NOTE_TYPE ? 5. : 2.;
		}
		
		if($value > $max) {
			return $noteType == BenchmarkField::DESC_NOTE_TYPE ? 2. : 5.;
		}
		
		if ($max > $min) {
			if ($noteType == BenchmarkField::DESC_NOTE_TYPE) {
				return 5. - 3. * ($value - $min) / ($max - $min);
			} else {
				return 2. + 3. * ($value - $min) / ($max - $min);
			}
		}
		return 5.;
	}
}