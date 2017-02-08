<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;
use AppBundle\Entity\Base\Image;
use AppBundle\Utils\ClassUtils;

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
		$brandName = ClassUtils::getCleanName($this->getBrand()->getName());
		return 'uploads/products/' . substr($brandName, 0, 1) . '/' . $brandName;
	}
	
    /**
     * @var string
     */
    private $price;

    /**
     * @var integer
     */
    private $guarantee;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productCategoryAssignments;

    /**
     * @var \AppBundle\Entity\Brand
     */
    private $brand;

    /**
     * Constructor
     */
    public function __construct() {
    	parent::__construct();
        $this->productCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set price
     *
     * @param string $price
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
     * @return string
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
     * Add productCategoryAssignment
     *
     * @param \AppBundle\Entity\ProductCategoryAssignment $productCategoryAssignment
     *
     * @return Product
     */
    public function addProductCategoryAssignment(\AppBundle\Entity\ProductCategoryAssignment $productCategoryAssignment)
    {
        $this->productCategoryAssignments[] = $productCategoryAssignment;

        return $this;
    }

    /**
     * Remove productCategoryAssignment
     *
     * @param \AppBundle\Entity\ProductCategoryAssignment $productCategoryAssignment
     */
    public function removeProductCategoryAssignment(\AppBundle\Entity\ProductCategoryAssignment $productCategoryAssignment)
    {
        $this->productCategoryAssignments->removeElement($productCategoryAssignment);
    }

    /**
     * Get productCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductCategoryAssignments()
    {
        return $this->productCategoryAssignments;
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
     * @var string
     */
    private $topProduktImage;


    /**
     * Set topProduktImage
     *
     * @param string $topProduktImage
     *
     * @return Product
     */
    public function setTopProduktImage($topProduktImage)
    {
        $this->topProduktImage = $topProduktImage;

        return $this;
    }

    /**
     * Get topProduktImage
     *
     * @return string
     */
    public function getTopProduktImage()
    {
        return $this->topProduktImage;
    }
}
