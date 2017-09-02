<?php

namespace AppBundle\Filter\Common\Main;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class MenuEntryFilter extends SimpleEntityFilter {

	/**
	 *
	 * @var string
	 */
	protected $name = null;

	/**
	 *
	 * @var integer
	 */
	protected $infomarket = self::ALL_VALUES;

	/**
	 *
	 * @var integer
	 */
	protected $infoprodukt = self::ALL_VALUES;

	/**
	 *
	 * @var array
	 */
	protected $menus = array ();

	/**
	 *
	 * @var array
	 */
	protected $parents = array ();

	/**
	 *
	 * @var array
	 */
	protected $branches = array ();

	/**
	 *
	 * @var array
	 */
	protected $categories = array ();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->name = $this->getRequestString($request, 'name');
		
		$this->infomarket = $this->getRequestBool($request, 'infomarket');
		$this->infoprodukt = $this->getRequestBool($request, 'infoprodukt');
		
		$this->menus = $this->getRequestArray($request, 'menus');
		$this->parents = $this->getRequestArray($request, 'parents');
		$this->branches = $this->getRequestArray($request, 'branches');
		$this->categories = $this->getRequestArray($request, 'categories');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->name = null;
		
		$this->infomarket = self::ALL_VALUES;
		$this->infoprodukt = self::ALL_VALUES;
		
		$this->menus = array ();
		$this->parents = array ();
		$this->branches = array ();
		$this->categories = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'name', $this->name);
		
		$this->setRequestBool($values, 'infomarket', $this->infomarket);
		$this->setRequestBool($values, 'infoprodukt', $this->infoprodukt);
		
		$this->setRequestArray($values, 'menus', $this->menus);
		$this->setRequestArray($values, 'parents', $this->parents);
		$this->setRequestArray($values, 'branches', $this->branches);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}

	public function setName($name) {
		$this->name = $name;
		
		return $this;
	}

	public function getName() {
		return $this->name;
	}

	public function setInfomarket($infomarket) {
		$this->infomarket = $infomarket;
		
		return $this;
	}

	public function getInfomarket() {
		return $this->infomarket;
	}

	public function setInfoprodukt($infoprodukt) {
		$this->infoprodukt = $infoprodukt;
		
		return $this;
	}

	public function getInfoprodukt() {
		return $this->infoprodukt;
	}

	public function setMenus($menus) {
		$this->menus = $menus;
		
		return $this;
	}

	public function getMenus() {
		return $this->menus;
	}

	public function setParents($parents) {
		$this->parents = $parents;
		
		return $this;
	}

	public function getParents() {
		return $this->parents;
	}

	public function setBranches($branches) {
		$this->branches = $branches;
		
		return $this;
	}

	public function getBranches() {
		return $this->branches;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}
}