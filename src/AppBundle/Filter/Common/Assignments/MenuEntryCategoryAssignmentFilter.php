<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class MenuEntryCategoryAssignmentFilter extends SimpleEntityFilter {

	/**
	 *
	 * @var array
	 */
	protected $menuEntries = array ();

	/**
	 *
	 * @var array
	 */
	protected $categories = array ();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->menuEntries = $this->getRequestArray($request, 'menu_entries');
		$this->categories = $this->getRequestArray($request, 'categories');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->menuEntries = array ();
		$this->categories = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'menu_entries', $this->menuEntries);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}

	public function setMenuEntries($menuEntries) {
		$this->menuEntries = $menuEntries;
		
		return $this;
	}

	public function getMenuEntries() {
		return $this->menuEntries;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}
}