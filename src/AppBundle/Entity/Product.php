<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * Product
 */
class Product extends ImageEntity
{
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/products/' . $this->category->getTreePath();
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
     * @var \AppBundle\Entity\Category
     */
    private $category;


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
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Product
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
     * @var \AppBundle\Entity\Segment
     */
    private $segment;
    
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
     * Set segment
     *
     * @param \AppBundle\Entity\Segment $segment
     *
     * @return Product
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
}
