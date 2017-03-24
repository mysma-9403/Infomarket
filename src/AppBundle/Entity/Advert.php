<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * Article
 */
class Advert extends ImageEntity
{
	const TOP_LOCATION 		= 0;
	const SIDE_LOCATION 	= 1;
	const TEXT_LOCATION 	= 2;
	const FEATURED_LOCATION = 3;
	
	public static function getLocationName($location) {
		switch ($location) {
			case self::TOP_LOCATION:
				return 'label.advert.location.top';
			case self::SIDE_LOCATION:
				return 'label.advert.location.side';
			case self::TEXT_LOCATION:
				return 'label.advert.location.text';
			case self::FEATURED_LOCATION:
				return 'label.advert.location.featured';
			default:
				return null;
		}
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return 'uploads/adverts/' . $this->createdAt->format('Y/m/');
	}
	
    /**
     * @var \DateTime
     */
    private $dateFrom;

    /**
     * @var \DateTime
     */
    private $dateTo;

    /**
     * @var integer
     */
    private $location;

    /**
     * @var string
     */
    private $link;

    /**
     * @var integer
     */
    private $showCount;

    /**
     * @var integer
     */
    private $showLimit;

    /**
     * @var integer
     */
    private $clickCount;

    /**
     * @var integer
     */
    private $clickLimit;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $advertCategoryAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->advertCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     *
     * @return Advert
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return \DateTime
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set dateTo
     *
     * @param \DateTime $dateTo
     *
     * @return Advert
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * Get dateTo
     *
     * @return \DateTime
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * Set location
     *
     * @param integer $location
     *
     * @return Advert
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return integer
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Advert
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set showCount
     *
     * @param integer $showCount
     *
     * @return Advert
     */
    public function setShowCount($showCount)
    {
        $this->showCount = $showCount;

        return $this;
    }

    /**
     * Get showCount
     *
     * @return integer
     */
    public function getShowCount()
    {
        return $this->showCount;
    }

    /**
     * Set showLimit
     *
     * @param integer $showLimit
     *
     * @return Advert
     */
    public function setShowLimit($showLimit)
    {
        $this->showLimit = $showLimit;

        return $this;
    }

    /**
     * Get showLimit
     *
     * @return integer
     */
    public function getShowLimit()
    {
        return $this->showLimit;
    }

    /**
     * Set clickCount
     *
     * @param integer $clickCount
     *
     * @return Advert
     */
    public function setClickCount($clickCount)
    {
        $this->clickCount = $clickCount;

        return $this;
    }

    /**
     * Get clickCount
     *
     * @return integer
     */
    public function getClickCount()
    {
        return $this->clickCount;
    }

    /**
     * Set clickLimit
     *
     * @param integer $clickLimit
     *
     * @return Advert
     */
    public function setClickLimit($clickLimit)
    {
        $this->clickLimit = $clickLimit;

        return $this;
    }

    /**
     * Get clickLimit
     *
     * @return integer
     */
    public function getClickLimit()
    {
        return $this->clickLimit;
    }

    /**
     * Add advertCategoryAssignment
     *
     * @param \AppBundle\Entity\AdvertCategoryAssignment $advertCategoryAssignment
     *
     * @return Advert
     */
    public function addAdvertCategoryAssignment(\AppBundle\Entity\AdvertCategoryAssignment $advertCategoryAssignment)
    {
        $this->advertCategoryAssignments[] = $advertCategoryAssignment;

        return $this;
    }

    /**
     * Remove advertCategoryAssignment
     *
     * @param \AppBundle\Entity\AdvertCategoryAssignment $advertCategoryAssignment
     */
    public function removeAdvertCategoryAssignment(\AppBundle\Entity\AdvertCategoryAssignment $advertCategoryAssignment)
    {
        $this->advertCategoryAssignments->removeElement($advertCategoryAssignment);
    }

    /**
     * Get advertCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdvertCategoryAssignments()
    {
        return $this->advertCategoryAssignments;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $newsletterBlockAdvertAssignments;


    /**
     * Add newsletterBlockAdvertAssignment
     *
     * @param \AppBundle\Entity\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment
     *
     * @return Advert
     */
    public function addNewsletterBlockAdvertAssignment(\AppBundle\Entity\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment)
    {
        $this->newsletterBlockAdvertAssignments[] = $newsletterBlockAdvertAssignment;

        return $this;
    }

    /**
     * Remove newsletterBlockAdvertAssignment
     *
     * @param \AppBundle\Entity\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment
     */
    public function removeNewsletterBlockAdvertAssignment(\AppBundle\Entity\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment)
    {
        $this->newsletterBlockAdvertAssignments->removeElement($newsletterBlockAdvertAssignment);
    }

    /**
     * Get newsletterBlockAdvertAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewsletterBlockAdvertAssignments()
    {
        return $this->newsletterBlockAdvertAssignments;
    }
}
