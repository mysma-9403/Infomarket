<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\SimpleTree;

class MenuEntry extends SimpleTree {

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
	 * @var integer
	 */
	private $orderNumber;

	/**
	 *
	 * @var string
	 */
	private $slug;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $children;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $menuMenuEntryAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $menuEntryBranchAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $menuEntryCategoryAssignments;

	/**
	 *
	 * @var \AppBundle\Entity\Main\MenuEntry
	 */
	private $parent;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Page
	 */
	private $page;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Link
	 */
	private $link;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->children = new \Doctrine\Common\Collections\ArrayCollection();
		$this->menuMenuEntryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
		$this->menuEntryBranchAssignments = new \Doctrine\Common\Collections\ArrayCollection();
		$this->menuEntryCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Set infomarket
	 *
	 * @param boolean $infomarket        	
	 *
	 * @return MenuEntry
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
	 * @return MenuEntry
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
	 * Set orderNumber
	 *
	 * @param integer $orderNumber        	
	 *
	 * @return MenuEntry
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
	 * Set slug
	 *
	 * @param string $slug        	
	 *
	 * @return MenuEntry
	 */
	public function setSlug($slug) {
		$this->slug = $slug;
		
		return $this;
	}

	/**
	 * Get slug
	 *
	 * @return string
	 */
	public function getSlug() {
		return $this->slug;
	}

	/**
	 * Add child
	 *
	 * @param \AppBundle\Entity\Main\MenuEntry $child        	
	 *
	 * @return MenuEntry
	 */
	public function addChild(\AppBundle\Entity\Main\MenuEntry $child) {
		$this->children[] = $child;
		
		return $this;
	}

	/**
	 * Remove child
	 *
	 * @param \AppBundle\Entity\Main\MenuEntry $child        	
	 */
	public function removeChild(\AppBundle\Entity\Main\MenuEntry $child) {
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
	 * Add menuMenuEntryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MenuMenuEntryAssignment $menuMenuEntryAssignment        	
	 *
	 * @return MenuEntry
	 */
	public function addMenuMenuEntryAssignment(
			\AppBundle\Entity\Assignments\MenuMenuEntryAssignment $menuMenuEntryAssignment) {
		$this->menuMenuEntryAssignments[] = $menuMenuEntryAssignment;
		
		return $this;
	}

	/**
	 * Remove menuMenuEntryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MenuMenuEntryAssignment $menuMenuEntryAssignment        	
	 */
	public function removeMenuMenuEntryAssignment(
			\AppBundle\Entity\Assignments\MenuMenuEntryAssignment $menuMenuEntryAssignment) {
		$this->menuMenuEntryAssignments->removeElement($menuMenuEntryAssignment);
	}

	/**
	 * Get menuMenuEntryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getMenuMenuEntryAssignments() {
		return $this->menuMenuEntryAssignments;
	}

	/**
	 * Add menuEntryBranchAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MenuEntryBranchAssignment $menuEntryBranchAssignment        	
	 *
	 * @return MenuEntry
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

	/**
	 * Add menuEntryCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MenuEntryCategoryAssignment $menuEntryCategoryAssignment        	
	 *
	 * @return MenuEntry
	 */
	public function addMenuEntryCategoryAssignment(
			\AppBundle\Entity\Assignments\MenuEntryCategoryAssignment $menuEntryCategoryAssignment) {
		$this->menuEntryCategoryAssignments[] = $menuEntryCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove menuEntryCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MenuEntryCategoryAssignment $menuEntryCategoryAssignment        	
	 */
	public function removeMenuEntryCategoryAssignment(
			\AppBundle\Entity\Assignments\MenuEntryCategoryAssignment $menuEntryCategoryAssignment) {
		$this->menuEntryCategoryAssignments->removeElement($menuEntryCategoryAssignment);
	}

	/**
	 * Get menuEntryCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getMenuEntryCategoryAssignments() {
		return $this->menuEntryCategoryAssignments;
	}

	/**
	 * Set parent
	 *
	 * @param \AppBundle\Entity\Main\MenuEntry $parent        	
	 *
	 * @return MenuEntry
	 */
	public function setParent(\AppBundle\Entity\Main\MenuEntry $parent = null) {
		$this->parent = $parent;
		
		return $this;
	}

	/**
	 * Get parent
	 *
	 * @return \AppBundle\Entity\Main\MenuEntry
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * Set page
	 *
	 * @param \AppBundle\Entity\Main\Page $page        	
	 *
	 * @return MenuEntry
	 */
	public function setPage(\AppBundle\Entity\Main\Page $page = null) {
		$this->page = $page;
		
		return $this;
	}

	/**
	 * Get page
	 *
	 * @return \AppBundle\Entity\Main\Page
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * Set link
	 *
	 * @param \AppBundle\Entity\Main\Link $link        	
	 *
	 * @return MenuEntry
	 */
	public function setLink(\AppBundle\Entity\Main\Link $link = null) {
		$this->link = $link;
		
		return $this;
	}

	/**
	 * Get link
	 *
	 * @return \AppBundle\Entity\Main\Link
	 */
	public function getLink() {
		return $this->link;
	}
}
