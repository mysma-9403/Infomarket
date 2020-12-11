<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Image;

class Magazine extends Image {

	public function getDisplayName() {
		$result = parent::getDisplayName();
		if ($this->date) {
			$result = $this->date->format('Y-m') . ' ' . $result;
		}
		
		return $result;
	}

	public function getUploadPath() {
		return 'uploads/magazines';
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
	private $featured;

	/**
	 *
	 * @var boolean
	 */
	private $main;

	/**
	 *
	 * @var integer
	 */
	private $orderNumber;

	/**
	 *
	 * @var string
	 */
	private $magazineFile;

	/**
	 *
	 * @var string
	 */
	private $content;

	/**
	 *
	 * @var \DateTime
	 */
	private $date;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $children;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $magazineBranchAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $magazineCategoryAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $newsletterBlockMagazineAssignments;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Magazine
	 */
	private $parent;


	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return Magazine
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
	 * @return Magazine
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
	 * @return Magazine
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
	 * @return Magazine
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
	 * Set main
	 *
	 * @param boolean $main        	
	 *
	 * @return Magazine
	 */
	public function setMain($main) {
		$this->main = $main;
		
		return $this;
	}

	/**
	 * Get main
	 *
	 * @return boolean
	 */
	public function getMain() {
		return $this->main;
	}

	/**
	 * Set orderNumber
	 *
	 * @param integer $orderNumber        	
	 *
	 * @return Magazine
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
	 * Set magazineFile
	 *
	 * @param string $magazineFile        	
	 *
	 * @return Magazine
	 */
	public function setMagazineFile($magazineFile) {
		$this->magazineFile = $magazineFile;
		
		return $this;
	}

	/**
	 * Get magazineFile
	 *
	 * @return string
	 */
	public function getMagazineFile() {
		return $this->magazineFile;
	}

	/**
	 * Set content
	 *
	 * @param string $content        	
	 *
	 * @return Magazine
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
	 * Set date
	 *
	 * @param \DateTime $date        	
	 *
	 * @return Magazine
	 */
	public function setDate($date) {
		$this->date = $date;
		
		return $this;
	}

	/**
	 * Get date
	 *
	 * @return \DateTime
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * Add child
	 *
	 * @param \AppBundle\Entity\Main\Magazine $child        	
	 *
	 * @return Magazine
	 */
	public function addChild(\AppBundle\Entity\Main\Magazine $child) {
		$this->children[] = $child;
		
		return $this;
	}

	/**
	 * Remove child
	 *
	 * @param \AppBundle\Entity\Main\Magazine $child        	
	 */
	public function removeChild(\AppBundle\Entity\Main\Magazine $child) {
		$this->children->removeElement($child);
	}

	/**
	 * Get children
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getChildren() {
		return $this->children;
	}

	/**
	 * Add magazineBranchAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MagazineBranchAssignment $magazineBranchAssignment        	
	 *
	 * @return Magazine
	 */
	public function addMagazineBranchAssignment(
			\AppBundle\Entity\Assignments\MagazineBranchAssignment $magazineBranchAssignment) {
		$this->magazineBranchAssignments[] = $magazineBranchAssignment;
		
		return $this;
	}

	/**
	 * Remove magazineBranchAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MagazineBranchAssignment $magazineBranchAssignment        	
	 */
	public function removeMagazineBranchAssignment(
			\AppBundle\Entity\Assignments\MagazineBranchAssignment $magazineBranchAssignment) {
		$this->magazineBranchAssignments->removeElement($magazineBranchAssignment);
	}

	/**
	 * Get magazineBranchAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getMagazineBranchAssignments() {
		return $this->magazineBranchAssignments;
	}

	/**
	 * Add magazineCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MagazineCategoryAssignment $magazineCategoryAssignment        	
	 *
	 * @return Magazine
	 */
	public function addMagazineCategoryAssignment(
			\AppBundle\Entity\Assignments\MagazineCategoryAssignment $magazineCategoryAssignment) {
		$this->magazineCategoryAssignments[] = $magazineCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove magazineCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MagazineCategoryAssignment $magazineCategoryAssignment        	
	 */
	public function removeMagazineCategoryAssignment(
			\AppBundle\Entity\Assignments\MagazineCategoryAssignment $magazineCategoryAssignment) {
		$this->magazineCategoryAssignments->removeElement($magazineCategoryAssignment);
	}

	/**
	 * Get magazineCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getMagazineCategoryAssignments() {
		return $this->magazineCategoryAssignments;
	}

	/**
	 * Add newsletterBlockMagazineAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterBlockMagazineAssignment $newsletterBlockMagazineAssignment        	
	 *
	 * @return Magazine
	 */
	public function addNewsletterBlockMagazineAssignment(
			\AppBundle\Entity\Assignments\NewsletterBlockMagazineAssignment $newsletterBlockMagazineAssignment) {
		$this->newsletterBlockMagazineAssignments[] = $newsletterBlockMagazineAssignment;
		
		return $this;
	}

	/**
	 * Remove newsletterBlockMagazineAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterBlockMagazineAssignment $newsletterBlockMagazineAssignment        	
	 */
	public function removeNewsletterBlockMagazineAssignment(
			\AppBundle\Entity\Assignments\NewsletterBlockMagazineAssignment $newsletterBlockMagazineAssignment) {
		$this->newsletterBlockMagazineAssignments->removeElement($newsletterBlockMagazineAssignment);
	}

	/**
	 * Get newsletterBlockMagazineAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getNewsletterBlockMagazineAssignments() {
		return $this->newsletterBlockMagazineAssignments;
	}

	/**
	 * Set parent
	 *
	 * @param \AppBundle\Entity\Main\Magazine $parent        	
	 *
	 * @return Magazine
	 */
	public function setParent(\AppBundle\Entity\Main\Magazine $parent = null) {
		$this->parent = $parent;
		
		return $this;
	}

	/**
	 * Get parent
	 *
	 * @return \AppBundle\Entity\Main\Magazine
	 */
	public function getParent() {
		return $this->parent;
	}

	public function getCreatedAt()
    {
        return parent::getCreatedAt(); // TODO: Change the autogenerated stub
    }
}
