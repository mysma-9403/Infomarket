<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\BranchCategoryAssignment;

class CategoryFilter extends SimpleEntityFilter {

	/**
	 * 
	 * @var integer
	 */
	private $parent;
	
	/**
	 * 
	 * @var integer
	 */
	private $branch;
	
	protected function getJoinExpressions() {
		$expressions = parent::getJoinExpressions();
		
		if($this->branch)
			$expressions[] = BranchCategoryAssignment::class . ' bca WITH bca.category = e.id';
		
		return $expressions;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->branch)
			$expressions[] = 'bca.branch = ' . $this->branch->getId();
		
		$expressions[] = 'e.parent IS NULL';
		
		return $expressions;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getOrderByExpression() {
		return ' ORDER BY e.treePath ASC ';
	}
	
	/**
	 * Set parent
	 *
	 * @param integer $parent
	 *
	 * @return SimpleEntityFilter
	 */
	public function setParent($parent)
	{
		$this->parent = $parent;
	
		return $this;
	}
	
	/**
	 * Get parent
	 *
	 * @return integer
	 */
	public function getParent()
	{
		return $this->parent;
	}
	
	/**
	 * Set branch
	 *
	 * @param integer $branch
	 *
	 * @return SimpleEntityFilter
	 */
	public function setBranch($branch)
	{
		$this->branch = $branch;
	
		return $this;
	}
	
	/**
	 * Get branch
	 *
	 * @return integer
	 */
	public function getBranch()
	{
		return $this->branch;
	}
}