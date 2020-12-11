<?php

namespace AppBundle\Logic\Common\Product\NeighboursFinder;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Other\ProductValue;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;

class NeighboursFinder {

	/**
	 *
	 * @var BenchmarkFieldDataBaseUtils
	 */
	private $benchmarkFieldDataBaseUtils;

	public function __construct(BenchmarkFieldDataBaseUtils $benchmarkFieldDataBaseUtils) {
		$this->benchmarkFieldDataBaseUtils = $benchmarkFieldDataBaseUtils;
	}

	public function find(Product $product, Category $category, $limit) {
		$neighbours = $this->getAllNeighbours($product, $category);
		usort($neighbours, array($this, 'compareByDistance'));
		$neighbours = array_slice($neighbours, 0, $limit);
		
		$entries = [];
		
		foreach ($neighbours as $neighbour) {
			$entries[] = $neighbour['product'];
		}
		
		return $entries;
	}

	private function getAllNeighbours(Product $product, Category $category) {
		$neighbours = [];
		
		$productAssignment = $this->getAssignment($product, $category);
		
		/** @var ProductCategoryAssignment $assignment */
		foreach ($category->getProductCategoryAssignments() as $assignment) {
			if ($productAssignment->getId() != $assignment->getId()) {
				$distance = $this->calculateDistance($productAssignment->getProductValue(), 
						$assignment->getProductValue(), $this->getMainCategory($category));
				$neighbour = $assignment->getProduct();
				$neighbours[$neighbour->getId()] = ['distance' => $distance, 'product' => $neighbour];
			}
		}
		
		return $neighbours;
	}

	private function getAssignment(Product $product, Category $category) {
		/** @var ProductCategoryAssignment $assignment */
		foreach ($product->getProductCategoryAssignments() as $assignment) {
			if ($assignment->getCategory()->getId() == $category->getId()) {
				return $assignment;
			}
		}
		
		return null;
	}

	private function calculateDistance(ProductValue $productValue1, ProductValue $productValue2, 
			Category $category) {
		$distance = 0;
		
		/** @var BenchmarkField $field */
		foreach ($category->getBenchmarkFields() as $field) {
			if ($field->getCompareWeight() > 0) {
				$offset = $this->benchmarkFieldDataBaseUtils->getValueField($field);
				$value1 = $productValue1->offsetGet($offset);
				$value2 = $productValue2->offsetGet($offset);
				
				$distance += $field->getCompareWeight() * abs($value1 - $value2);
			}
		}
		
		return $distance;
	}

	/**
	 *
	 * @param Category $category
	 *
	 * @return Category
	 */
	private function getMainCategory(Category $category) {
		while ($category->getParent()) {
			if ($category->getParent()->getPreleaf()) {
				return $category;
			}
			$category = $category->getParent();
		}
	
		return null;
	}
	
	private function compareByDistance($a, $b) {
		return $a['distance'] - $b['distance'];
	}
}