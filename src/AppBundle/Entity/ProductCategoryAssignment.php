<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * ProductCategoryAssignment
 */
class ProductCategoryAssignment extends Audit
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
     * @var \AppBundle\Entity\Product
     */
    private $product;

    /**
     * @var \AppBundle\Entity\Segment
     */
    private $segment;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return ProductCategoryAssignment
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
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return ProductCategoryAssignment
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set segment
     *
     * @param \AppBundle\Entity\Segment $segment
     *
     * @return ProductCategoryAssignment
     */
    public function setSegment(\AppBundle\Entity\Segment $segment = null)
    {
        $this->segment = $segment;

        return $this;
    }

    /**
     * Get segment
     *
     * @return \AppBundle\Entity\Segment
     */
    public function getSegment()
    {
        return $this->segment;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return ProductCategoryAssignment
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
    /**
     * @var boolean
     */
    private $featured;


    /**
     * Set featured
     *
     * @param boolean $featured
     *
     * @return ProductCategoryAssignment
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
}
