<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Image;

class Advert extends Image {

	const TOP_LOCATION = 0;

	const SIDE_LOCATION = 1;

	const TEXT_LOCATION = 2;

	const FEATURED_LOCATION = 3;

	public static function getLocationParam($location) { // TODO move somewhere else
		switch ($location) {
			case self::TOP_LOCATION:
				return 'topAds';
			case self::SIDE_LOCATION:
				return 'sideAds';
			case self::TEXT_LOCATION:
				return 'textAds';
			case self::FEATURED_LOCATION:
				return 'featuredAds';
			default:
				return null;
		}
	}

	public function getUploadPath() {
		return 'uploads/adverts/' . $this->getCreatedAt()->format('Y/m/');
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
	 * @var \DateTime
	 */
	private $dateFrom;

	/**
	 *
	 * @var \DateTime
	 */
	private $dateTo;

	/**
	 *
	 * @var integer
	 */
	private $location;

	/**
	 *
	 * @var string
	 */
	private $link;

	/**
	 *
	 * @var integer
	 */
	private $showCount;

	/**
	 *
	 * @var integer
	 */
	private $showLimit;

	/**
	 *
	 * @var integer
	 */
	private $clickCount;

	/**
	 *
	 * @var integer
	 */
	private $clickLimit;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $advertCategoryAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $newsletterBlockAdvertAssignments;

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return Advert
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
	 * @return Advert
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
	 * @return Advert
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
	 * Set dateFrom
	 *
	 * @param \DateTime $dateFrom        	
	 *
	 * @return Advert
	 */
	public function setDateFrom($dateFrom) {
		$this->dateFrom = $dateFrom;
		
		return $this;
	}

	/**
	 * Get dateFrom
	 *
	 * @return \DateTime
	 */
	public function getDateFrom() {
		return $this->dateFrom;
	}

	/**
	 * Set dateTo
	 *
	 * @param \DateTime $dateTo        	
	 *
	 * @return Advert
	 */
	public function setDateTo($dateTo) {
		$this->dateTo = $dateTo;
		
		return $this;
	}

	/**
	 * Get dateTo
	 *
	 * @return \DateTime
	 */
	public function getDateTo() {
		return $this->dateTo;
	}

	/**
	 * Set location
	 *
	 * @param integer $location        	
	 *
	 * @return Advert
	 */
	public function setLocation($location) {
		$this->location = $location;
		
		return $this;
	}

	/**
	 * Get location
	 *
	 * @return integer
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * Set link
	 *
	 * @param string $link        	
	 *
	 * @return Advert
	 */
	public function setLink($link) {
		$this->link = $link;
		
		return $this;
	}

	/**
	 * Get link
	 *
	 * @return string
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * Set showCount
	 *
	 * @param integer $showCount        	
	 *
	 * @return Advert
	 */
	public function setShowCount($showCount) {
		$this->showCount = $showCount;
		
		return $this;
	}

	/**
	 * Get showCount
	 *
	 * @return integer
	 */
	public function getShowCount() {
		return $this->showCount;
	}

	/**
	 * Set showLimit
	 *
	 * @param integer $showLimit        	
	 *
	 * @return Advert
	 */
	public function setShowLimit($showLimit) {
		$this->showLimit = $showLimit;
		
		return $this;
	}

	/**
	 * Get showLimit
	 *
	 * @return integer
	 */
	public function getShowLimit() {
		return $this->showLimit;
	}

	/**
	 * Set clickCount
	 *
	 * @param integer $clickCount        	
	 *
	 * @return Advert
	 */
	public function setClickCount($clickCount) {
		$this->clickCount = $clickCount;
		
		return $this;
	}

	/**
	 * Get clickCount
	 *
	 * @return integer
	 */
	public function getClickCount() {
		return $this->clickCount;
	}

	/**
	 * Set clickLimit
	 *
	 * @param integer $clickLimit        	
	 *
	 * @return Advert
	 */
	public function setClickLimit($clickLimit) {
		$this->clickLimit = $clickLimit;
		
		return $this;
	}

	/**
	 * Get clickLimit
	 *
	 * @return integer
	 */
	public function getClickLimit() {
		return $this->clickLimit;
	}

	/**
	 * Add advertCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\AdvertCategoryAssignment $advertCategoryAssignment        	
	 *
	 * @return Advert
	 */
	public function addAdvertCategoryAssignment(
			\AppBundle\Entity\Assignments\AdvertCategoryAssignment $advertCategoryAssignment) {
		$this->advertCategoryAssignments[] = $advertCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove advertCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\AdvertCategoryAssignment $advertCategoryAssignment        	
	 */
	public function removeAdvertCategoryAssignment(
			\AppBundle\Entity\Assignments\AdvertCategoryAssignment $advertCategoryAssignment) {
		$this->advertCategoryAssignments->removeElement($advertCategoryAssignment);
	}

	/**
	 * Get advertCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getAdvertCategoryAssignments() {
		return $this->advertCategoryAssignments;
	}

	/**
	 * Add newsletterBlockAdvertAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment        	
	 *
	 * @return Advert
	 */
	public function addNewsletterBlockAdvertAssignment(
			\AppBundle\Entity\Assignments\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment) {
		$this->newsletterBlockAdvertAssignments[] = $newsletterBlockAdvertAssignment;
		
		return $this;
	}

	/**
	 * Remove newsletterBlockAdvertAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment        	
	 */
	public function removeNewsletterBlockAdvertAssignment(
			\AppBundle\Entity\Assignments\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment) {
		$this->newsletterBlockAdvertAssignments->removeElement($newsletterBlockAdvertAssignment);
	}

	/**
	 * Get newsletterBlockAdvertAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getNewsletterBlockAdvertAssignments() {
		return $this->newsletterBlockAdvertAssignments;
	}
}
