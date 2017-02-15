<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\Branch;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class BranchCategoryAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $branches = array();
	
	/**
	 *
	 * @var array
	 */
	protected $categories = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->branches = $this->getRequestArray($request, 'branches');
		$this->categories = $this->getRequestArray($request, 'categories');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->branches = array();
		$this->categories = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'branches', $this->branches);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}
	
	/**
	 * Set branches
	 *
	 * @param array $branches
	 *
	 * @return BranchCategoryAssignmentFilter
	 */
	public function setBranches($branches)
	{
		$this->branches = $branches;
	
		return $this;
	}
	
	/**
	 * Get branches
	 *
	 * @return array
	 */
	public function getBranches()
	{
		return $this->branches;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return BranchCategoryAssignmentFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get branch categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}