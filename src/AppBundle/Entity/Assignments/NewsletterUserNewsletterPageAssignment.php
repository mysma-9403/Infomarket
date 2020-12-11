<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class NewsletterUserNewsletterPageAssignment extends Simple {

	const WAITING_STATE = 1;

	const SENDING_STATE = 2;

	const SENT_STATE = 3;

	const ERROR_STATE = 4;

	public static function getStateName($state) { // TODO move somewhere else
		switch ($state) {
			case self::WAITING_STATE:
				return 'label.newsletterUserNewsletterPageAssignment.state.waiting';
			case self::SENDING_STATE:
				return 'label.newsletterUserNewsletterPageAssignment.state.sending';
			case self::SENT_STATE:
				return 'label.newsletterUserNewsletterPageAssignment.state.sent';
			case self::ERROR_STATE:
				return 'label.newsletterUserNewsletterPageAssignment.state.error';
			default:
				return '';
		}
	}

	public function getDisplayName() {
		return $this->newsletterPage->getDisplayName();
	}

	/**
	 *
	 * @var integer
	 */
	private $state;

	/**
	 *
	 * @var boolean
	 */
	private $embedImages;

	/**
	 *
	 * @var \DateTime
	 */
	private $processingTime;

	/**
	 *
	 * @var \AppBundle\Entity\Main\NewsletterUser
	 */
	private $newsletterUser;

	/**
	 *
	 * @var \AppBundle\Entity\Main\NewsletterPage
	 */
	private $newsletterPage;

	/**
	 * Set state
	 *
	 * @param integer $state        	
	 *
	 * @return NewsletterUserNewsletterPageAssignment
	 */
	public function setState($state) {
		$this->state = $state;
		
		return $this;
	}

	/**
	 * Get state
	 *
	 * @return integer
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * Set embedImages
	 *
	 * @param boolean $embedImages        	
	 *
	 * @return NewsletterUserNewsletterPageAssignment
	 */
	public function setEmbedImages($embedImages) {
		$this->embedImages = $embedImages;
		
		return $this;
	}

	/**
	 * Get embedImages
	 *
	 * @return boolean
	 */
	public function getEmbedImages() {
		return $this->embedImages;
	}

	/**
	 * Set processingTime
	 *
	 * @param \DateTime $processingTime        	
	 *
	 * @return NewsletterUserNewsletterPageAssignment
	 */
	public function setProcessingTime($processingTime) {
		$this->processingTime = $processingTime;
		
		return $this;
	}

	/**
	 * Get processingTime
	 *
	 * @return \DateTime
	 */
	public function getProcessingTime() {
		return $this->processingTime;
	}

	/**
	 * Set newsletterUser
	 *
	 * @param \AppBundle\Entity\Main\NewsletterUser $newsletterUser        	
	 *
	 * @return NewsletterUserNewsletterPageAssignment
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
	 * Set newsletterPage
	 *
	 * @param \AppBundle\Entity\Main\NewsletterPage $newsletterPage        	
	 *
	 * @return NewsletterUserNewsletterPageAssignment
	 */
	public function setNewsletterPage(\AppBundle\Entity\Main\NewsletterPage $newsletterPage = null) {
		$this->newsletterPage = $newsletterPage;
		
		return $this;
	}

	/**
	 * Get newsletterPage
	 *
	 * @return \AppBundle\Entity\Main\NewsletterPage
	 */
	public function getNewsletterPage() {
		return $this->newsletterPage;
	}
}
