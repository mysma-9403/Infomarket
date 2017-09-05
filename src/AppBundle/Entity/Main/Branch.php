<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Image;

class Branch extends Image {

	public function getUploadPath() {
		return 'uploads/branches';
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
	private $color;

	/**
	 *
	 * @var string
	 */
	private $icon;

	/**
	 *
	 * @var integer
	 */
	private $orderNumber;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $branchCategoryAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $magazineBranchAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $menuEntryBranchAssignments;

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return Branch
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
	 * @return Branch
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
	 * @return Branch
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
	 * @return Branch
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
	 * Set color
	 *
	 * @param string $color        	
	 *
	 * @return Branch
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
	 * Set icon
	 *
	 * @param string $icon        	
	 *
	 * @return Branch
	 */
	public function setIcon($icon) {
		$this->icon = $icon;
		
		return $this;
	}

	/**
	 * Get icon
	 *
	 * @return string
	 */
	public function getIcon() {
		return $this->icon;
	}

	/**
	 * Set orderNumber
	 *
	 * @param integer $orderNumber        	
	 *
	 * @return Branch
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
	 * Add branchCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\BranchCategoryAssignment $branchCategoryAssignment        	
	 *
	 * @return Branch
	 */
	public function addBranchCategoryAssignment(
			\AppBundle\Entity\Assignments\BranchCategoryAssignment $branchCategoryAssignment) {
		$this->branchCategoryAssignments[] = $branchCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove branchCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\BranchCategoryAssignment $branchCategoryAssignment        	
	 */
	public function removeBranchCategoryAssignment(
			\AppBundle\Entity\Assignments\BranchCategoryAssignment $branchCategoryAssignment) {
		$this->branchCategoryAssignments->removeElement($branchCategoryAssignment);
	}

	/**
	 * Get branchCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getBranchCategoryAssignments() {
		return $this->branchCategoryAssignments;
	}

	/**
	 * Add magazineBranchAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MagazineBranchAssignment $magazineBranchAssignment        	
	 *
	 * @return Branch
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
	 * Add menuEntryBranchAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MenuEntryBranchAssignment $menuEntryBranchAssignment        	
	 *
	 * @return Branch
	 */
	public function addMenuEntryBranchAssignment(
			\AppBundle\Entity\Assignments\MenuEntryBranchAssignment $menuEntryBranchAssignment) {
		$this->menuEntryBranchAssignments[] = $menuEntryBranchAssignment;
		
		return $this;
	}

	/**
	 * Remove menuEntryBranchAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MenuEntryBranchAssignment $menuEntryBranchAssignment        	
	 */
	public function removeMenuEntryBranchAssignment(
			\AppBundle\Entity\Assignments\MenuEntryBranchAssignment $menuEntryBranchAssignment) {
		$this->menuEntryBranchAssignments->removeElement($menuEntryBranchAssignment);
	}

	/**
	 * Get menuEntryBranchAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getMenuEntryBranchAssignments() {
		return $this->menuEntryBranchAssignments;
	}
}
