<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\Menu;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class MenuMenuEntryAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $menus = array();
	
	/**
	 *
	 * @var array
	 */
	protected $menuEntries = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->menus = $this->getRequestArray($request, 'menus');
		$this->menuEntries = $this->getRequestArray($request, 'menu_entries');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->menus = array();
		$this->menuEntries = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'menus', $this->menus);
		$this->setRequestArray($values, 'menu_entries', $this->menuEntries);
		
		return $values;
	}
	
	/**
	 * Set menus
	 *
	 * @param array $menus
	 *
	 * @return MenuMenuEntryAssignmentFilter
	 */
	public function setMenus($menus)
	{
		$this->menus = $menus;
	
		return $this;
	}
	
	/**
	 * Get menus
	 *
	 * @return array
	 */
	public function getMenus()
	{
		return $this->menus;
	}
	
	/**
	 * Set menuEntries
	 *
	 * @param array $menuEntries
	 *
	 * @return MenuMenuEntryAssignmentFilter
	 */
	public function setMenuEntries($menuEntries)
	{
		$this->menuEntries = $menuEntries;
	
		return $this;
	}
	
	/**
	 * Get menu menuEntries
	 *
	 * @return array
	 */
	public function getMenuEntries()
	{
		return $this->menuEntries;
	}
}