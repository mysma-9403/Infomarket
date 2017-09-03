<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class NewsletterUserNewsletterGroupAssignment extends Simple {

	public function getDisplayName() {
		return $this->newsletterGroup->getDisplayName();
	}

	/**
	 *
	 * @var \AppBundle\Entity\Main\NewsletterUser
	 */
	private $newsletterUser;

	/**
	 *
	 * @var \AppBundle\Entity\Main\NewsletterGroup
	 */
	private $newsletterGroup;

	/**
	 * Set newsletterUser
	 *
	 * @param \AppBundle\Entity\Main\NewsletterUser $newsletterUser        	
	 *
	 * @return NewsletterUserNewsletterGroupAssignment
	 */
	public function setNewsletterUser(\AppBundle\Entity\Main\NewsletterUser $newsletterUser = null) {
		$this->newsletterUser = $newsletterUser;
		
		return $this;
	}

	/**
	 * Get newsletterUser
	 *
	 * @return \AppBundle\Entity\Main\NewsletterUser
	 */
	public function getNewsletterUser() {
		return $this->newsletterUser;
	}

	/**
	 * Set newsletterGroup
	 *
	 * @param \AppBundle\Entity\Main\NewsletterGroup $newsletterGroup        	
	 *
	 * @return NewsletterUserNewsletterGroupAssignment
	 */
	public function setNewsletterGroup(\AppBundle\Entity\Main\NewsletterGroup $newsletterGroup = null) {
		$this->newsletterGroup = $newsletterGroup;
		
		return $this;
	}

	/**
	 * Get newsletterGroup
	 *
	 * @return \AppBundle\Entity\Main\NewsletterGroup
	 */
	public function getNewsletterGroup() {
		return $this->newsletterGroup;
	}
}
