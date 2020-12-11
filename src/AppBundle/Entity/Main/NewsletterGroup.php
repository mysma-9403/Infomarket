<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Simple;

class NewsletterGroup extends Simple {

	const INFOMARKET_GROUP = 1;

	const INFOPRODUKT_GROUP = 2;

	public function getDisplayName() {
		return $this->getName();
	}

	/**
	 *
	 * @var string
	 */
	private $name;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $newsletterUserNewsletterGroupAssignments;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->newsletterUserNewsletterGroupAssignments = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return NewsletterGroup
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
	 * Add newsletterUserNewsletterGroupAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterUserNewsletterGroupAssignment $newsletterUserNewsletterGroupAssignment        	
	 *
	 * @return NewsletterGroup
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
}
