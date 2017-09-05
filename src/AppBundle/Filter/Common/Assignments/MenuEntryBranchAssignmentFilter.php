<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class MenuEntryBranchAssignmentFilter extends SimpleFilter {

	/**
	 *
	 * @var array
	 */
	protected $menuEntries = array ();

	/**
	 *
	 * @var array
	 */
	protected $branches = array ();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->menuEntries = $this->getRequestArray($request, 'menu_entries');
		$this->branches = $this->getRequestArray($request, 'branches');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->menuEntries = array ();
		$this->branches = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'menu_entries', $this->menuEntries);
		$this->setRequestArray($values, 'branches', $this->branches);
		
		return $values;
	}

	public function setMenuEntries($menuEntries) {
		$this->menuEntries = $menuEntries;
		
		return $this;
	}

	public function getMenuEntries() {
		return $this->menuEntries;
	}

	public function setBranches($branches) {
		$this->branches = $branches;
		
		return $this;
	}

	public function getBranches() {
		return $this->branches;
	}
}