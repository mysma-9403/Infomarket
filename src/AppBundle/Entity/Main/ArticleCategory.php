<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Image;

class ArticleCategory extends Image {

	public function getDisplayName() {
		$result = parent::getDisplayName();
		if ($this->subname) {
			if ($result == '<empty>')
				$result = $this->subname;
			else
				$result .= ' ' . $this->subname;
		}
		
		return $result;
	}

	public function getUploadPath() {
		return 'uploads/article-categories';
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
	 * @var boolean
	 */
	private $featured;

	/**
	 *
	 * @var integer
	 */
	private $orderNumber;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $articleArticleCategoryAssignments;

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return ArticleCategory
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
	 * @return ArticleCategory
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
	 * @return ArticleCategory
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
	 * @return ArticleCategory
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
	 * Set featured
	 *
	 * @param boolean $featured        	
	 *
	 * @return ArticleCategory
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
	 * Set orderNumber
	 *
	 * @param integer $orderNumber        	
	 *
	 * @return ArticleCategory
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
	 * Add articleArticleCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ArticleArticleCategoryAssignment $articleArticleCategoryAssignment        	
	 *
	 * @return ArticleCategory
	 */
	public function addArticleArticleCategoryAssignment(
			\AppBundle\Entity\Assignments\ArticleArticleCategoryAssignment $articleArticleCategoryAssignment) {
		$this->articleArticleCategoryAssignments[] = $articleArticleCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove articleArticleCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ArticleArticleCategoryAssignment $articleArticleCategoryAssignment        	
	 */
	public function removeArticleArticleCategoryAssignment(
			\AppBundle\Entity\Assignments\ArticleArticleCategoryAssignment $articleArticleCategoryAssignment) {
		$this->articleArticleCategoryAssignments->removeElement($articleArticleCategoryAssignment);
	}

	/**
	 * Get articleArticleCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getArticleArticleCategoryAssignments() {
		return $this->articleArticleCategoryAssignments;
	}
}
