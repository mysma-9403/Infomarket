<?php

namespace AppBundle\Filter\Common\Main;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class ProductFilter extends SimpleEntityFilter {

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
	protected $brands = array ();

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
		
		$this->brands = $this->getRequestArray($request, 'brands');
		$this->categories = $this->getRequestArray($request, 'categories');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->name = null;
		
		$this->infomarket = self::ALL_VALUES;
		$this->infoprodukt = self::ALL_VALUES;
		
		$this->brands = array ();
		$this->categories = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'name', $this->name);
		
		$this->setRequestBool($values, 'infomarket', $this->infomarket);
		$this->setRequestBool($values, 'infoprodukt', $this->infoprodukt);
		
		$this->setRequestArray($values, 'brands', $this->brands);
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

	public function setBrands($brands) {
		$this->brands = $brands;
		
		return $this;
	}

	public function getBrands() {
		return $this->brands;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}
}