<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Simple;

class NewsletterUser extends Simple {

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
	private $subscribed;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $newsletterUserNewsletterGroupAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $newsletterUserNewsletterPageAssignments;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->newsletterUserNewsletterGroupAssignments = new \Doctrine\Common\Collections\ArrayCollection();
		$this->newsletterUserNewsletterPageAssignments = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return NewsletterUser
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
	 * @return NewsletterUser
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
	 * @return NewsletterUser
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
	 * Set subscribed
	 *
	 * @param boolean $subscribed        	
	 *
	 * @return NewsletterUser
	 */
	public function setSubscribed($subscribed) {
		$this->subscribed = $subscribed;
		
		return $this;
	}

	/**
	 * Get subscribed
	 *
	 * @return boolean
	 */
	public function getSubscribed() {
		return $this->subscribed;
	}

	/**
	 * Add newsletterUserNewsletterGroupAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterUserNewsletterGroupAssignment $newsletterUserNewsletterGroupAssignment        	
	 *
	 * @return NewsletterUser
	 */
	public function addNewsletterUserNewsletterGroupAssignment(
			\AppBundle\Entity\Assignments\NewsletterUserNewsletterGroupAssignment $newsletterUserNewsletterGroupAssignment) {
		$this->newsletterUserNewsletterGroupAssignments[] = $newsletterUserNewsletterGroupAssignment;
		
		return $this;
	}

	/**
	 * Remove newsletterUserNewsletterGroupAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterUserNewsletterGroupAssignment $newsletterUserNewsletterGroupAssignment        	
	 */
	public function removeNewsletterUserNewsletterGroupAssignment(
			\AppBundle\Entity\Assignments\NewsletterUserNewsletterGroupAssignment $newsletterUserNewsletterGroupAssignment) {
		$this->newsletterUserNewsletterGroupAssignments->removeElement($newsletterUserNewsletterGroupAssignment);
	}

	/**
	 * Get newsletterUserNewsletterGroupAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getNewsletterUserNewsletterGroupAssignments() {
		return $this->newsletterUserNewsletterGroupAssignments;
	}

	/**
	 * Add newsletterUserNewsletterPageAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterUserNewsletterPageAssignment $newsletterUserNewsletterPageAssignment        	
	 *
	 * @return NewsletterUser
	 */
	public function addNewsletterUserNewsletterPageAssignment(
			\AppBundle\Entity\Assignments\NewsletterUserNewsletterPageAssignment $newsletterUserNewsletterPageAssignment) {
		$this->newsletterUserNewsletterPageAssignments[] = $newsletterUserNewsletterPageAssignment;
		
		return $this;
	}

	/**
	 * Remove newsletterUserNewsletterPageAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterUserNewsletterPageAssignment $newsletterUserNewsletterPageAssignment        	
	 */
	public function removeNewsletterUserNewsletterPageAssignment(
			\AppBundle\Entity\Assignments\NewsletterUserNewsletterPageAssignment $newsletterUserNewsletterPageAssignment) {
		$this->newsletterUserNewsletterPageAssignments->removeElement($newsletterUserNewsletterPageAssignment);
	}

	/**
	 * Get newsletterUserNewsletterPageAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getNewsletterUserNewsletterPageAssignments() {
		return $this->newsletterUserNewsletterPageAssignments;
	}
}
