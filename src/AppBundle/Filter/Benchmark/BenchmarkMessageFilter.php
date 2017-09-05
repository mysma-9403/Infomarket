<?php

namespace AppBundle\Filter\Benchmark;

use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkMessageFilter extends SimpleFilter {

	/**
	 *
	 * @var string
	 */
	protected $name;

	/**
	 *
	 * @var integer
	 */
	protected $readByAuthor = self::ALL_VALUES;

	/**
	 *
	 * @var array
	 */
	protected $products;

	/**
	 *
	 * @var array
	 */
	protected $states;

	/**
	 *
	 * @var integer
	 */
	protected $contextUser;

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->name = $this->getRequestString($request, 'name');
		
		$this->readByAuthor = $this->getRequestBool($request, 'read_by_admin');
		
		$this->products = $this->getRequestArray($request, 'products');
		$this->states = $this->getRequestArray($request, 'states');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->name = null;
		
		$this->readByAuthor = self::ALL_VALUES;
		
		$this->products = array ();
		$this->states = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'name', $this->name);
		
		$this->setRequestBool($values, 'read_by_admin', $this->readByAuthor);
		
		$this->setRequestArray($values, 'products', $this->products);
		$this->setRequestArray($values, 'states', $this->states);
		
		return $values;
	}

	public function setName($name) {
		$this->name = $name;
		
		return $this;
	}

	public function getName() {
		return $this->name;
	}

	public function setReadByAuthor($readByAuthor) {
		$this->readByAuthor = $readByAuthor;
		
		return $this;
	}

	public function getReadByAuthor() {
		return $this->readByAuthor;
	}

	public function setProducts($products) {
		$this->products = $products;
		
		return $this;
	}

	public function getProducts() {
		return $this->products;
	}

	public function setStates($states) {
		$this->states = $states;
		
		return $this;
	}

	public function getStates() {
		return $this->states;
	}

	public function setContextUser($contextUser) {
		$this->contextUser = $contextUser;
		
		return $this;
	}

	public function getContextUser() {
		return $this->contextUser;
	}
}