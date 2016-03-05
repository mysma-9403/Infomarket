<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\TermCategoryAssignment;

class TermFilter extends SimpleEntityFilter {

	/**
	 * 
	 * @var integer
	 */
	private $categories;
	
	protected function getJoinExpressions() {
		$expressions = parent::getJoinExpressions();
	
		if($this->categories)
			$expressions[] = TermCategoryAssignment::class . ' tca WITH tca.term = e.id';
	
		return $expressions;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->categories)
			$expressions[] = $this->getEqualArrayExpression('tca.category', $this->categories);
		
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
	 * @return TermFilter
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