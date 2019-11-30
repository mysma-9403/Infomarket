<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Simple;

class Term extends Simple {

	public function getDisplayName() {
		return $this->name;
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
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $termCategoryAssignments;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->termCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return Term
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
	 * @return Term
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
	 * @return Term
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
	 * @return Term
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
	 * Add termCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\TermCategoryAssignment $termCategoryAssignment        	
	 *
	 * @return Term
	 */
	public function addTermCategoryAssignment(
			\AppBundle\Entity\Assignments\TermCategoryAssignment $termCategoryAssignment) {
		$this->termCategoryAssignments[] = $termCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove termCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\TermCategoryAssignment $termCategoryAssignment        	
	 */
	public function removeTermCategoryAssignment(
			\AppBundle\Entity\Assignments\TermCategoryAssignment $termCategoryAssignment) {
		$this->termCategoryAssignments->removeElement($termCategoryAssignment);
	}

	/**
	 * Get termCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getTermCategoryAssignments() {
		return $this->termCategoryAssignments;
	}
}
