<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class NewsletterBlockAdvertAssignment extends Simple {

	public function getDisplayName() {
		return $this->advert->getDisplayName();
	}

	/**
	 *
	 * @var integer
	 */
	private $orderNumber;

	/**
	 *
	 * @var \AppBundle\Entity\Main\NewsletterBlock
	 */
	private $newsletterBlock;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Advert
	 */
	private $advert;

	/**
	 * Set orderNumber
	 *
	 * @param integer $orderNumber        	
	 *
	 * @return NewsletterBlockAdvertAssignment
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
	 * Set newsletterBlock
	 *
	 * @param \AppBundle\Entity\Main\NewsletterBlock $newsletterBlock        	
	 *
	 * @return NewsletterBlockAdvertAssignment
	 */
	public function setNewsletterBlock(\AppBundle\Entity\Main\NewsletterBlock $newsletterBlock = null) {
		$this->newsletterBlock = $newsletterBlock;
		
		return $this;
	}

	/**
	 * Get newsletterBlock
	 *
	 * @return \AppBundle\Entity\Main\NewsletterBlock
	 */
	public function getNewsletterBlock() {
		return $this->newsletterBlock;
	}

	/**
	 * Set advert
	 *
	 * @param \AppBundle\Entity\Main\Advert $advert        	
	 *
	 * @return NewsletterBlockAdvertAssignment
	 */
	public function setAdvert(\AppBundle\Entity\Main\Advert $advert = null) {
		$this->advert = $advert;
		
		return $this;
	}

	/**
	 * Get advert
	 *
	 * @return \AppBundle\Entity\Main\Advert
	 */
	public function getAdvert() {
		return $this->advert;
	}
}
