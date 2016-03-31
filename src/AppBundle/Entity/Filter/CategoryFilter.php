<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\BranchCategoryAssignment;

class CategoryFilter extends SimpleEntityFilter {

	/**
	 *
	 * @var boolean
	 */
	private $root;
	
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
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getFilterName()
	 */
	protected function getFilterName() {
		return 'category_filter_';
	}
	
	protected function getJoinExpressions() {
		$expressions = parent::getJoinExpressions();
		
		if($this->branch)
			$expressions[] = BranchCategoryAssignment::class . ' bca WITH bca.category = e.id';
		
		return $expressions;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->branch) {
			$expressions[] = 'bca.branch = ' . $this->branch->getId();
		}
		
		if($this->root) {
			$expressions[] = 'e.parent IS NULL';
		} else if($this->parent) {
			$expressions[] = 'e.parent = ' . $this->parent->getId();
		}
		
		return $expressions;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getOrderByExpression() {
		return ' ORDER BY e.treePath ASC ';
	}
	
	/**
	 * Set root
	 *
	 * @param boolean $root
	 *
	 * @return SimpleEntityFilter
	 */
	public function setRoot($root)
	{
		$this->root = $root;
	
		return $this;
	}
	
	/**
	 * Get root
	 *
	 * @return boolean
	 */
	public function getRoot()
	{
		return $this->root;
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