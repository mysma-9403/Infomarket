<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Simple;

class Menu extends Simple {

	const FOOTER_MENU = 1;

	const MAIN_MENU = 2;

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
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $menuMenuEntryAssignments;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->menuMenuEntryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return Menu
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
	 * @return Menu
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
	 * @return Menu
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
	 * Add menuMenuEntryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MenuMenuEntryAssignment $menuMenuEntryAssignment        	
	 *
	 * @return Menu
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
}
