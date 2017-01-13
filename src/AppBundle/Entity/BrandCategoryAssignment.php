<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * BrandCategoryAssignment
 */
class BrandCategoryAssignment extends Audit
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->category->getDisplayName();
	}
	
    /**
     * @var integer
     */
    private $orderNumber;

    /**
     * @var \AppBundle\Entity\Brand
     */
    private $brand;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return BrandCategoryAssignment
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
     * Set brand
     *
     * @param \AppBundle\Entity\Brand $brand
     *
     * @return BrandCategoryAssignment
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
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return BrandCategoryAssignment
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
