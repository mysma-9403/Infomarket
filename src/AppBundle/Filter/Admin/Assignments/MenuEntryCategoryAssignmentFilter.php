<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class MenuEntryCategoryAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $menuEntries = array();
	
	/**
	 *
	 * @var array
	 */
	protected $categories = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->menuEntries = $this->getRequestArray($request, 'menu_entries');
		$this->categories = $this->getRequestArray($request, 'categories');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->menuEntries = array();
		$this->categories = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'menu_entries', $this->menuEntries);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}
	
	/**
	 * Set menuEntries
	 *
	 * @param array $menuEntries
	 *
	 * @return MenuEntryCategoryAssignmentFilter
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
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return MenuEntryCategoryAssignmentFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get menuEntry categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}