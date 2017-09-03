<?php

namespace AppBundle\Filter\Common\Main;

use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class AdvertFilter extends SimpleFilter {

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
	 * @var string
	 */
	protected $link;

	/**
	 *
	 * @var array
	 */
	protected $categories;

	/**
	 *
	 * @var array
	 */
	protected $locations;

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->name = $this->getRequestString($request, 'name');
		
		$this->infomarket = $this->getRequestBool($request, 'infomarket');
		$this->infoprodukt = $this->getRequestBool($request, 'infoprodukt');
		
		$this->link = $this->getRequestValue($request, 'link');
		
		$this->categories = $this->getRequestArray($request, 'categories');
		$this->locations = $this->getRequestArray($request, 'locations');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->name = null;
		
		$this->infomarket = self::ALL_VALUES;
		$this->infoprodukt = self::ALL_VALUES;
		
		$this->link = null;
		
		$this->categories = array ();
		$this->locations = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'name', $this->name);
		
		$this->setRequestBool($values, 'infomarket', $this->infomarket);
		$this->setRequestBool($values, 'infoprodukt', $this->infoprodukt);
		
		$this->setRequestValue($values, 'link', $this->link);
		
		$this->setRequestArray($values, 'categories', $this->categories);
		$this->setRequestArray($values, 'locations', $this->locations);
		
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

	public function setLink($link) {
		$this->link = $link;
		
		return $this;
	}

	public function getLink() {
		return $this->link;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}

	public function setLocations($locations) {
		$this->locations = $locations;
		
		return $this;
	}

	public function getLocations() {
		return $this->locations;
	}
}