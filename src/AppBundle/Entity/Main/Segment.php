<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Image;

class Segment extends Image {

	public function getUploadPath() {
		return 'uploads/segments';
	}

	/**
	 *
	 * @var string
	 */
	private $name;

	/**
	 *
	 * @var string
	 */
	private $subname;

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
	 * @var string
	 */
	private $content;

	/**
	 *
	 * @var integer
	 */
	private $orderNumber;

	/**
	 *
	 * @var string
	 */
	private $color;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $productCategoryAssignments;

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return Segment
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
	 * Set subname
	 *
	 * @param string $subname        	
	 *
	 * @return Segment
	 */
	public function setSubname($subname) {
		$this->subname = $subname;
		
		return $this;
	}

	/**
	 * Get subname
	 *
	 * @return string
	 */
	public function getSubname() {
		return $this->subname;
	}

	/**
	 * Set infomarket
	 *
	 * @param boolean $infomarket        	
	 *
	 * @return Segment
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
	 * @return Segment
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
	 * Set content
	 *
	 * @param string $content        	
	 *
	 * @return Segment
	 */
	public function setContent($content) {
		$this->content = $content;
		
		return $this;
	}

	/**
	 * Get content
	 *
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Set orderNumber
	 *
	 * @param integer $orderNumber        	
	 *
	 * @return Segment
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
	 * Set color
	 *
	 * @param string $color        	
	 *
	 * @return Segment
	 */
	public function setColor($color) {
		$this->color = $color;
		
		return $this;
	}

	/**
	 * Get color
	 *
	 * @return string
	 */
	public function getColor() {
		return $this->color;
	}

	/**
	 * Add productCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment        	
	 *
	 * @return Segment
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
}
