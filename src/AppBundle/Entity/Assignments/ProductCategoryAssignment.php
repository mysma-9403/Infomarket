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
	 * @var \AppBundle\Entity\Other\ProductValue
	 */
	private $productValue;

	/**
	 *
	 * @var \AppBundle\Entity\Other\ProductScore
	 */
	private $productScore;

	/**
	 *
	 * @var \AppBundle\Entity\Other\ProductNote
	 */
	private $productNote;

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
	 * Set productValue
	 *
	 * @param \AppBundle\Entity\Other\ProductValue $productValue        	
	 *
	 * @return ProductCategoryAssignment
	 */
	public function setProductValue(\AppBundle\Entity\Other\ProductValue $productValue = null) {
		$this->productValue = $productValue;
		
		return $this;
	}

	/**
	 * Get productValue
	 *
	 * @return \AppBundle\Entity\Other\ProductValue
	 */
	public function getProductValue() {
		return $this->productValue;
	}

	/**
	 * Set productScore
	 *
	 * @param \AppBundle\Entity\Other\ProductScore $productScore        	
	 *
	 * @return ProductCategoryAssignment
	 */
	public function setProductScore(\AppBundle\Entity\Other\ProductScore $productScore = null) {
		$this->productScore = $productScore;
		
		return $this;
	}

	/**
	 * Get productScore
	 *
	 * @return \AppBundle\Entity\Other\ProductScore
	 */
	public function getProductScore() {
		return $this->productScore;
	}

	/**
	 * Set productNote
	 *
	 * @param \AppBundle\Entity\Other\ProductNote $productNote        	
	 *
	 * @return ProductCategoryAssignment
	 */
	public function setProductNote(\AppBundle\Entity\Other\ProductNote $productNote = null) {
		$this->productNote = $productNote;
		
		return $this;
	}

	/**
	 * Get productNote
	 *
	 * @return \AppBundle\Entity\Other\ProductNote
	 */
	public function getProductNote() {
		return $this->productNote;
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
