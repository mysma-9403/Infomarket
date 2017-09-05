<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class ProductCategoryAssignment extends Simple {

	public function getDisplayName() {
		return $this->category->getDisplayName();
	}

	/**
	 *
	 * @var integer
	 */
	private $orderNumber;

	/**
	 *
	 * @var boolean
	 */
	private $featured;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Product
	 */
	private $product;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Segment
	 */
	private $segment;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Category
	 */
	private $category;

	/**
	 * Set orderNumber
	 *
	 * @param integer $orderNumber        	
	 *
	 * @return ProductCategoryAssignment
	 */
	public function setOrderNumber($orderNumber) {
		$this->orderNumber = $orderNumber;
		
		return $this;
	}

	/**
	 * Get orderNumber
	 *
	 * @return integer
	 */
	public function getOrderNumber() {
		return $this->orderNumber;
	}

	/**
	 * Set featured
	 *
	 * @param boolean $featured        	
	 *
	 * @return ProductCategoryAssignment
	 */
	public function setFeatured($featured) {
		$this->featured = $featured;
		
		return $this;
	}

	/**
	 * Get featured
	 *
	 * @return boolean
	 */
	public function getFeatured() {
		return $this->featured;
	}

	/**
	 * Set product
	 *
	 * @param \AppBundle\Entity\Main\Product $product        	
	 *
	 * @return ProductCategoryAssignment
	 */
	public function setProduct(\AppBundle\Entity\Main\Product $product = null) {
		$this->product = $product;
		
		return $this;
	}

	/**
	 * Get product
	 *
	 * @return \AppBundle\Entity\Main\Product
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * Set segment
	 *
	 * @param \AppBundle\Entity\Main\Segment $segment        	
	 *
	 * @return ProductCategoryAssignment
	 */
	public function setSegment(\AppBundle\Entity\Main\Segment $segment = null) {
		$this->segment = $segment;
		
		return $this;
	}

	/**
	 * Get segment
	 *
	 * @return \AppBundle\Entity\Main\Segment
	 */
	public function getSegment() {
		return $this->segment;
	}

	/**
	 * Set category
	 *
	 * @param \AppBundle\Entity\Main\Category $category        	
	 *
	 * @return ProductCategoryAssignment
	 */
	public function setCategory(\AppBundle\Entity\Main\Category $category = null) {
		$this->category = $category;
		
		return $this;
	}

	/**
	 * Get category
	 *
	 * @return \AppBundle\Entity\Main\Category
	 */
	public function getCategory() {
		return $this->category;
	}
}