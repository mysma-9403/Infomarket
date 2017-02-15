<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle;
use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class MenuEntryFilter extends SimpleEntityFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $menus = array();
	
	/**
	 *
	 * @var array
	 */
	protected $parents = array();
	
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
	
		$this->menus = $this->getRequestArray($request, 'menus');
		$this->parents = $this->getRequestArray($request, 'parents');
		$this->branches = $this->getRequestArray($request, 'branches');
		$this->categories = $this->getRequestArray($request, 'categories');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->menus = array();
		$this->parents = array();
		$this->branches = array();
		$this->categories = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'menus', $this->menus);
		$this->setRequestArray($values, 'parents', $this->parents);
		$this->setRequestArray($values, 'branches', $this->branches);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}
	
	/**
	 * Set menus
	 *
	 * @param array $menus
	 *
	 * @return MenuEntryFilter
	 */
	public function setMenus($menus)
	{
		$this->menus = $menus;
	
		return $this;
	}
	
	/**
	 * Get term menus
	 *
	 * @return array
	 */
	public function getMenus()
	{
		return $this->menus;
	}
	
	/**
	 * Set parents
	 *
	 * @param array $parents
	 *
	 * @return MenuEntryFilter
	 */
	public function setParents($parents)
	{
		$this->parents = $parents;
	
		return $this;
	}
	
	/**
	 * Get term parents
	 *
	 * @return array
	 */
	public function getParents()
	{
		return $this->parents;
	}
	
	/**
	 * Set branches
	 *
	 * @param array $branches
	 *
	 * @return MenuEntryFilter
	 */
	public function setBranches($branches)
	{
		$this->branches = $branches;
	
		return $this;
	}
	
	/**
	 * Get term branches
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
	 * @return MenuEntryFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get term categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}