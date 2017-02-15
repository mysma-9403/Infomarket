<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\Product;
use AppBundle\Filter\Admin\Base\AuditFilter;
use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class ProductCategoryAssignmentFilter extends AuditFilter {
	
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
	
	/**
	 * Set products
	 *
	 * @param array $products
	 *
	 * @return ProductCategoryAssignmentFilter
	 */
	public function setProducts($products)
	{
		$this->products = $products;
	
		return $this;
	}
	
	/**
	 * Get products
	 *
	 * @return array
	 */
	public function getProducts()
	{
		return $this->products;
	}
	
	/**
	 * Set brands
	 *
	 * @param array $brands
	 *
	 * @return BrandCategoryAssignmentFilter
	 */
	public function setBrands($brands)
	{
		$this->brands = $brands;
	
		return $this;
	}
	
	/**
	 * Get brands
	 *
	 * @return array
	 */
	public function getBrands()
	{
		return $this->brands;
	}
	
	/**
	 * Set segments
	 *
	 * @param array $segments
	 *
	 * @return SegmentCategoryAssignmentFilter
	 */
	public function setSegments($segments)
	{
		$this->segments = $segments;
	
		return $this;
	}
	
	/**
	 * Get segments
	 *
	 * @return array
	 */
	public function getSegments()
	{
		return $this->segments;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return ProductCategoryAssignmentFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get product categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
	/**
	 * Set featured
	 *
	 * @param integer $featured
	 *
	 * @return SimpleEntityFilter
	 */
	public function setFeatured($featured)
	{
		$this->featured = $featured;
	
		return $this;
	}
	
	/**
	 * Get featured
	 *
	 * @return integer
	 */
	public function getFeatured()
	{
		return $this->featured;
	}
}