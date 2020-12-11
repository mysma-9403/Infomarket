<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Image;

class Brand extends Image {

	public function getDisplayName() {
		return $this->name;
	}
	
	public function getUploadPath() {
		return 'uploads/brands/' . substr($this->name, 0, 1);
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
	 * @var string
	 */
	private $content;

	/**
	 *
	 * @var string
	 */
	private $www;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $products;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $articleBrandAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $brandCategoryAssignments;

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return Brand
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
	 * @return Brand
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
	 * @return Brand
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
	 * @return Brand
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
	 * Set www
	 *
	 * @param string $www        	
	 *
	 * @return Brand
	 */
	public function setWww($www) {
		$this->www = $www;
		
		return $this;
	}

	/**
	 * Get www
	 *
	 * @return string
	 */
	public function getWww() {
		return $this->www;
	}

	/**
	 * Add product
	 *
	 * @param \AppBundle\Entity\Main\Product $product        	
	 *
	 * @return Brand
	 */
	public function addProduct(\AppBundle\Entity\Main\Product $product) {
		$this->products[] = $product;
		
		return $this;
	}

	/**
	 * Remove product
	 *
	 * @param \AppBundle\Entity\Main\Product $product        	
	 */
	public function removeProduct(\AppBundle\Entity\Main\Product $product) {
		$this->products->removeElement($product);
	}

	/**
	 * Get products
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getProducts() {
		return $this->products;
	}

	/**
	 * Add articleBrandAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ArticleBrandAssignment $articleBrandAssignment        	
	 *
	 * @return Brand
	 */
	public function addArticleBrandAssignment(
			\AppBundle\Entity\Assignments\ArticleBrandAssignment $articleBrandAssignment) {
		$this->articleBrandAssignments[] = $articleBrandAssignment;
		
		return $this;
	}

	/**
	 * Remove articleBrandAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ArticleBrandAssignment $articleBrandAssignment        	
	 */
	public function removeArticleBrandAssignment(
			\AppBundle\Entity\Assignments\ArticleBrandAssignment $articleBrandAssignment) {
		$this->articleBrandAssignments->removeElement($articleBrandAssignment);
	}

	/**
	 * Get articleBrandAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getArticleBrandAssignments() {
		return $this->articleBrandAssignments;
	}

	/**
	 * Add brandCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\BrandCategoryAssignment $brandCategoryAssignment        	
	 *
	 * @return Brand
	 */
	public function addBrandCategoryAssignment(
			\AppBundle\Entity\Assignments\BrandCategoryAssignment $brandCategoryAssignment) {
		$this->brandCategoryAssignments[] = $brandCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove brandCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\BrandCategoryAssignment $brandCategoryAssignment        	
	 */
	public function removeBrandCategoryAssignment(
			\AppBundle\Entity\Assignments\BrandCategoryAssignment $brandCategoryAssignment) {
		$this->brandCategoryAssignments->removeElement($brandCategoryAssignment);
	}

	/**
	 * Get brandCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getBrandCategoryAssignments() {
		return $this->brandCategoryAssignments;
	}
}
