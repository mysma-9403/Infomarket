<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class MenuMenuEntryAssignmentFilter extends SimpleEntityFilter {

	/**
	 *
	 * @var array
	 */
	protected $menus = array ();

	/**
	 *
	 * @var array
	 */
	protected $menuEntries = array ();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->menus = $this->getRequestArray($request, 'menus');
		$this->menuEntries = $this->getRequestArray($request, 'menu_entries');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->menus = array ();
		$this->menuEntries = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'menus', $this->menus);
		$this->setRequestArray($values, 'menu_entries', $this->menuEntries);
		
		return $values;
	}

	public function setMenus($menus) {
		$this->menus = $menus;
		
		return $this;
	}

	public function getMenus() {
		return $this->menus;
	}

	public function setMenuEntries($menuEntries) {
		$this->menuEntries = $menuEntries;
		
		return $this;
	}

	public function getMenuEntries() {
		return $this->menuEntries;
	}
}