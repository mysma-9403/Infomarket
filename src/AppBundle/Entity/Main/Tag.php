<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Simple;

class Tag extends Simple {

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
	private $articleTagAssignments;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->articleTagAssignments = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return Tag
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
	 * @return Tag
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
	 * @return Tag
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
	 * Add articleTagAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ArticleTagAssignment $articleTagAssignment        	
	 *
	 * @return Tag
	 */
	public function addArticleTagAssignment(
			\AppBundle\Entity\Assignments\ArticleTagAssignment $articleTagAssignment) {
		$this->articleTagAssignments[] = $articleTagAssignment;
		
		return $this;
	}

	/**
	 * Remove articleTagAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ArticleTagAssignment $articleTagAssignment        	
	 */
	public function removeArticleTagAssignment(
			\AppBundle\Entity\Assignments\ArticleTagAssignment $articleTagAssignment) {
		$this->articleTagAssignments->removeElement($articleTagAssignment);
	}

	/**
	 * Get articleTagAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getArticleTagAssignments() {
		return $this->articleTagAssignments;
	}
}
