<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class BrandCategoryAssignment extends Simple {

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
	 * @var \AppBundle\Entity\Main\Brand
	 */
	private $brand;

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
	 * @return BrandCategoryAssignment
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
	 * Set brand
	 *
	 * @param \AppBundle\Entity\Main\Brand $brand        	
	 *
	 * @return BrandCategoryAssignment
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
	 * Set category
	 *
	 * @param \AppBundle\Entity\Main\Category $category        	
	 *
	 * @return BrandCategoryAssignment
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
