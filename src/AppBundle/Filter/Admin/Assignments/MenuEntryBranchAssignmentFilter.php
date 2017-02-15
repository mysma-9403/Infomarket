<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class MenuEntryBranchAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $menuEntries = array();
	
	/**
	 *
	 * @var array
	 */
	protected $branches = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->menuEntries = $this->getRequestArray($request, 'menu_entries');
		$this->branches = $this->getRequestArray($request, 'branches');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->menuEntries = array();
		$this->branches = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'menu_entries', $this->menuEntries);
		$this->setRequestArray($values, 'branches', $this->branches);
		
		return $values;
	}
	
	/**
	 * Set menuEntries
	 *
	 * @param array $menuEntries
	 *
	 * @return MenuEntryBranchAssignmentFilter
	 */
	public function setMenuEntries($menuEntries)
	{
		$this->menuEntries = $menuEntries;
	
		return $this;
	}
	
	/**
	 * Get menuEntries
	 *
	 * @return array
	 */
	public function getMenuEntries()
	{
		return $this->menuEntries;
	}
	
	/**
	 * Set branches
	 *
	 * @param array $branches
	 *
	 * @return MenuEntryBranchAssignmentFilter
	 */
	public function setBranches($branches)
	{
		$this->branches = $branches;
	
		return $this;
	}
	
	/**
	 * Get menuEntry branches
	 *
	 * @return array
	 */
	public function getBranches()
	{
		return $this->branches;
	}
}