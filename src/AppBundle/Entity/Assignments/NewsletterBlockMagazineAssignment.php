<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class NewsletterBlockMagazineAssignment extends Simple {

	public function getDisplayName() {
		return $this->magazine->getDisplayName();
	}

	/**
	 *
	 * @var integer
	 */
	private $orderNumber;

	/**
	 *
	 * @var string
	 */
	private $alternativeName;

	/**
	 *
	 * @var \AppBundle\Entity\Main\NewsletterBlock
	 */
	private $newsletterBlock;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Magazine
	 */
	private $magazine;

	/**
	 * Set orderNumber
	 *
	 * @param integer $orderNumber        	
	 *
	 * @return NewsletterBlockMagazineAssignment
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
	 * Set alternativeName
	 *
	 * @param string $alternativeName        	
	 *
	 * @return NewsletterBlockMagazineAssignment
	 */
	public function setAlternativeName($alternativeName) {
		$this->alternativeName = $alternativeName;
		
		return $this;
	}

	/**
	 * Get alternativeName
	 *
	 * @return string
	 */
	public function getAlternativeName() {
		return $this->alternativeName;
	}

	/**
	 * Set newsletterBlock
	 *
	 * @param \AppBundle\Entity\Main\NewsletterBlock $newsletterBlock        	
	 *
	 * @return NewsletterBlockMagazineAssignment
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
	 * Set magazine
	 *
	 * @param \AppBundle\Entity\Main\Magazine $magazine        	
	 *
	 * @return NewsletterBlockMagazineAssignment
	 */
	public function setMagazine(\AppBundle\Entity\Main\Magazine $magazine = null) {
		$this->magazine = $magazine;
		
		return $this;
	}

	/**
	 * Get magazine
	 *
	 * @return \AppBundle\Entity\Main\Magazine
	 */
	public function getMagazine() {
		return $this->magazine;
	}
}
