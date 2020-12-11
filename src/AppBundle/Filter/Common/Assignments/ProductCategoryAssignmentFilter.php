<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class ProductCategoryAssignmentFilter extends SimpleFilter {

	/**
	 *
	 * @var array
	 */
	protected $products = array();

	/**
	 *
	 * @var array
	 */
	protected $brands = array();

	/**
	 *
	 * @var array
	 */
	protected $segments = array();

	/**
	 *
	 * @var array
	 */
	protected $categories = array();

	/**
	 *
	 * @var integer
	 */
	protected $featured = self::ALL_VALUES;

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->products = $this->getRequestArray($request, 'products');
		$this->brands = $this->getRequestArray($request, 'brands');
		$this->segments = $this->getRequestArray($request, 'segments');
		$this->categories = $this->getRequestArray($request, 'categories');
		
		$this->featured = $this->getRequestBool($request, 'featured');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->products = array();
		$this->brands = array();
		$this->segments = array();
		$this->categories = array();
		
		$this->featured = self::ALL_VALUES;
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'products', $this->products);
		$this->setRequestArray($values, 'brands', $this->brands);
		$this->setRequestArray($values, 'segments', $this->segments);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		$this->setRequestBool($values, 'featured', $this->featured);
		
		return $values;
	}

	public function setProducts($products) {
		$this->products = $products;
		
		return $this;
	}

	public function getProducts() {
		return $this->products;
	}

	public function setBrands($brands) {
		$this->brands = $brands;
		
		return $this;
	}

	public function getBrands() {
		return $this->brands;
	}

	public function setSegments($segments) {
		$this->segments = $segments;
		
		return $this;
	}

	public function getSegments() {
		return $this->segments;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}

	public function setFeatured($featured) {
		$this->featured = $featured;
		
		return $this;
	}

	public function getFeatured() {
		return $this->featured;
	}
}