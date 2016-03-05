<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\BrandCategoryAssignment;

class BrandFilter extends SimpleEntityFilter {

	/**
	 * 
	 * @var integer
	 */
	private $categories;
	
	protected function getJoinExpressions() {
		$expressions = parent::getJoinExpressions();
	
		if($this->categories)
			$expressions[] = BrandCategoryAssignment::class . ' bca WITH bca.brand = e.id';
	
		return $expressions;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->categories)
			$expressions[] = $this->getEqualArrayExpression('bca.category', $this->categories);
		
		return $expressions;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getOrderByExpression() {
		return ' ORDER BY e.name ASC ';
	}
	
	/**
	 * Set brand categories
	 *
	 * @param array $categories
	 *
	 * @return BrandFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get branch
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}