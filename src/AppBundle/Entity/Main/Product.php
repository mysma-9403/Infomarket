<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Image;
use AppBundle\Utils\StringUtils;

class Product extends Image {

	public function getDisplayName() {
		if ($this->brand) {
			return $this->brand->getName() . ' ' . $this->getName();
		}
		return $this->name;
	}

	public function getUploadPath() {
		$brandName = StringUtils::getCleanName($this->getBrand()->getName());
		return 'uploads/products/' . substr($brandName, 0, 1) . '/' . $brandName;
	}

	public function __construct() {
		parent::__construct();
		
		$this->infomarket = false;
		$this->infoprodukt = false;
		$this->custom = false;
	}

	/**
	 *
	 * @var string
	 */
	private $name;

	/**
	 *
	 * @var boolean
	 */
	private $infomarket;

	/**
	 *
	 * @var boolean
	 */
	private $infoprodukt;

	/**
	 *
	 * @var boolean
	 */
	private $custom;

	/**
	 *
	 * @var string
	 */
	private $topProduktImage;

	/**
	 *
	 * @var string
	 */
	private $price;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $productCategoryAssignments;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Brand
	 */
	private $brand;

	/**
	 *
	 * @var \AppBundle\Entity\Main\BenchmarkQuery
	 */
	private $benchmarkQuery;

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return Product
	 */
	public function setName($name) {
		$this->name = $name;
		
		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set infomarket
	 *
	 * @param boolean $infomarket        	
	 *
	 * @return Product
	 */
	public function setInfomarket($infomarket) {
		$this->infomarket = $infomarket;
		
		return $this;
	}

	/**
	 * Get infomarket
	 *
	 * @return boolean
	 */
	public function getInfomarket() {
		return $this->infomarket;
	}

	/**
	 * Set infoprodukt
	 *
	 * @param boolean $infoprodukt        	
	 *
	 * @return Product
	 */
	public function setInfoprodukt($infoprodukt) {
		$this->infoprodukt = $infoprodukt;
		
		return $this;
	}

	/**
	 * Get infoprodukt
	 *
	 * @return boolean
	 */
	public function getInfoprodukt() {
		return $this->infoprodukt;
	}

	/**
	 * Set custom
	 *
	 * @param boolean $custom        	
	 *
	 * @return Product
	 */
	public function setCustom($custom) {
		$this->custom = $custom;
		
		return $this;
	}

	/**
	 * Get custom
	 *
	 * @return boolean
	 */
	public function getCustom() {
		return $this->custom;
	}

	/**
	 * Set topProduktImage
	 *
	 * @param string $topProduktImage        	
	 *
	 * @return Product
	 */
	public function setTopProduktImage($topProduktImage) {
		$this->topProduktImage = $topProduktImage;
		
		return $this;
	}

	/**
	 * Get topProduktImage
	 *
	 * @return string
	 */
	public function getTopProduktImage() {
		return $this->topProduktImage;
	}

	/**
	 * Set price
	 *
	 * @param string $price        	
	 *
	 * @return Product
	 */
	public function setPrice($price) {
		$this->price = $price;
		
		return $this;
	}

	/**
	 * Get price
	 *
	 * @return string
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Add productCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment        	
	 *
	 * @return Product
	 */
	public function addProductCategoryAssignment(
			\AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment) {
		$this->productCategoryAssignments[] = $productCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove productCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment        	
	 */
	public function removeProductCategoryAssignment(
			\AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment) {
		$this->productCategoryAssignments->removeElement($productCategoryAssignment);
	}

	/**
	 * Get productCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getProductCategoryAssignments() {
		return $this->productCategoryAssignments;
	}

	/**
	 * Set brand
	 *
	 * @param \AppBundle\Entity\Main\Brand $brand        	
	 *
	 * @return Product
	 */
	public function setBrand(\AppBundle\Entity\Main\Brand $brand = null) {
		$this->brand = $brand;
		
		return $this;
	}

	/**
	 * Get brand
	 *
	 * @return \AppBundle\Entity\Main\Brand
	 */
	public function getBrand() {
		return $this->brand;
	}

	/**
	 * Set benchmarkQuery
	 *
	 * @param \AppBundle\Entity\Main\BenchmarkQuery $benchmarkQuery        	
	 *
	 * @return Product
	 */
	public function setBenchmarkQuery(\AppBundle\Entity\Main\BenchmarkQuery $benchmarkQuery = null) {
		$this->benchmarkQuery = $benchmarkQuery;
		
		return $this;
	}

	/**
	 * Get benchmarkQuery
	 *
	 * @return \AppBundle\Entity\Main\BenchmarkQuery
	 */
	public function getBenchmarkQuery() {
		return $this->benchmarkQuery;
	}
}
