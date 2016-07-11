<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * Product
 */
class Product extends ImageEntity
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Image::getDisplayName()
	 */
	public function getDisplayName() {
		if($this->brand) {
			return $this->brand->getName() . ' ' . $this->getName();
		}
		return $this->name;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/products/' . substr($this->getBrand()->getName(), 0, 1) . '/' . $this->getBrand()->getName();
	}
	
	
    /**
     * @var string
     */
    private $intro;

    /**
     * @var string
     */
    private $content;


    /**
     * Set intro
     *
     * @param string $intro
     *
     * @return Product
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * Get intro
     *
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Product
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
     * @var integer
     */
    private $price;

    /**
     * @var integer
     */
    private $guarantee;

    /**
     * @var \AppBundle\Entity\Brand
     */
    private $brand;
    
    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set guarantee
     *
     * @param integer $guarantee
     *
     * @return Product
     */
    public function setGuarantee($guarantee)
    {
        $this->guarantee = $guarantee;

        return $this;
    }

    /**
     * Get guarantee
     *
     * @return integer
     */
    public function getGuarantee()
    {
        return $this->guarantee;
    }

    /**
     * Set brand
     *
     * @param \AppBundle\Entity\Brand $brand
     *
     * @return Product
     */
    public function setBrand(\AppBundle\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \AppBundle\Entity\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categoryAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add categoryAssignment
     *
     * @param \AppBundle\Entity\ProductCategoryAssignment $categoryAssignment
     *
     * @return Product
     */
    public function addCategoryAssignment(\AppBundle\Entity\ProductCategoryAssignment $categoryAssignment)
    {
        $this->categoryAssignments[] = $categoryAssignment;

        return $this;
    }

    /**
     * Remove categoryAssignment
     *
     * @param \AppBundle\Entity\ProductCategoryAssignment $categoryAssignment
     */
    public function removeCategoryAssignment(\AppBundle\Entity\ProductCategoryAssignment $categoryAssignment)
    {
        $this->categoryAssignments->removeElement($categoryAssignment);
    }

    /**
     * Get categoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoryAssignments()
    {
        return $this->categoryAssignments;
    }
}
