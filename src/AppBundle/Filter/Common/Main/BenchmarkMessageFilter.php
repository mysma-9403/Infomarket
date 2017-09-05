<?php

namespace AppBundle\Filter\Common\Main;

use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkMessageFilter extends SimpleFilter {

	/**
	 *
	 * @var integer
	 */
	protected $readByAdmin = self::ALL_VALUES;

	/**
	 *
	 * @var array
	 */
	protected $products;

	/**
	 *
	 * @var array
	 */
	protected $authors;

	/**
	 *
	 * @var array
	 */
	protected $states;

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->readByAdmin = $this->getRequestBool($request, 'read_by_admin');
		
		$this->products = $this->getRequestArray($request, 'products');
		$this->authors = $this->getRequestArray($request, 'authors');
		$this->states = $this->getRequestArray($request, 'states');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->readByAdmin = self::ALL_VALUES;
		
		$this->products = array ();
		$this->authors = array ();
		$this->states = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestBool($values, 'read_by_admin', $this->readByAdmin);
		
		$this->setRequestArray($values, 'products', $this->products);
		$this->setRequestArray($values, 'authors', $this->authors);
		$this->setRequestArray($values, 'states', $this->states);
		
		return $values;
	}

	public function setReadByAdmin($readByAdmin) {
		$this->readByAdmin = $readByAdmin;
		
		return $this;
	}

	public function getReadByAdmin() {
		return $this->readByAdmin;
	}

	public function setProducts($products) {
		$this->products = $products;
		
		return $this;
	}

	public function getProducts() {
		return $this->products;
	}

	public function setAuthors($authors) {
		$this->authors = $authors;
		
		return $this;
	}

	public function getAuthors() {
		return $this->authors;
	}

	public function setStates($states) {
		$this->states = $states;
		
		return $this;
	}

	public function getStates() {
		return $this->states;
	}
}