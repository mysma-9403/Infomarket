<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * Magazine
 */
class Magazine extends ImageEntity
{
	public function getDisplayName() {
		$result = parent::getDisplayName();
		if($this->date) {
			$result = $this->date->format('Y-m') . ' ' . $result;
		}
		
		return $result;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/magazines';
	}

    /**
     * @var boolean
     */
    private $featured;

    /**
     * @var integer
     */
    private $orderNumber;

    /**
     * @var string
     */
    private $magazineFile;

    /**
     * @var string
     */
    private $content;


    /**
     * Set featured
     *
     * @param boolean $featured
     *
     * @return Magazine
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return boolean
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return Magazine
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get orderNumber
     *
     * @return integer
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Set magazineFile
     *
     * @param string $magazineFile
     *
     * @return Magazine
     */
    public function setMagazineFile($magazineFile)
    {
        $this->magazineFile = $magazineFile;

        return $this;
    }

    /**
     * Get magazineFile
     *
     * @return string
     */
    public function getMagazineFile()
    {
        return $this->magazineFile;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Magazine
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \AppBundle\Entity\Magazine
     */
    private $parent;


    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Magazine
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add child
     *
     * @param \AppBundle\Entity\Magazine $child
     *
     * @return Magazine
     */
    public function addChild(\AppBundle\Entity\Magazine $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\Magazine $child
     */
    public function removeChild(\AppBundle\Entity\Magazine $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\Magazine $parent
     *
     * @return Magazine
     */
    public function setParent(\AppBundle\Entity\Magazine $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Magazine
     */
    public function getParent()
    {
        return $this->parent;
    }
    /**
     * @var boolean
     */
    private $main;


    /**
     * Set main
     *
     * @param boolean $main
     *
     * @return Magazine
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return boolean
     */
    public function getMain()
    {
        return $this->main;
    }
}
