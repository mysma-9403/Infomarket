<?php

namespace AppBundle\Filter\Benchmark;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleEntityFilter;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class CustomProductFilter extends SimpleEntityFilter {

	/**
	 *
	 * @var string
	 */
	protected $name = null;

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

	/**
	 *
	 * @var integer
	 */
	protected $contextUser = null;

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->name = $this->getRequestString($request, 'name');
		
		$this->brands = $this->getRequestArray($request, 'brands');
		$this->categories = $this->getRequestArray($request, 'categories');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->name = null;
		
		$this->brands = array ();
		$this->categories = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'name', $this->name);
		
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

	public function setContextUser($contextUser) {
		$this->contextUser = $contextUser;
		
		return $this;
	}

	public function getContextUser() {
		return $this->contextUser;
	}
}