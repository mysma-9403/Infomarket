<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

class Segment extends ImageEntity
{
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/segments';
	}
	
    /**
     * @var string
     */
    private $content;

    /**
     * @var integer
     */
    private $orderNumber;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productCategoryAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->brandCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Segment
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
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return Segment
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
     * Add productCategoryAssignment
     *
     * @param \AppBundle\Entity\ProductCategoryAssignment $productCategoryAssignment
     *
     * @return Segment
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
     * @var string
     */
    private $color;


    /**
     * Set color
     *
     * @param string $color
     *
     * @return Segment
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }
    /**
     * @var string
     */
    private $subname;


    /**
     * Set subname
     *
     * @param string $subname
     *
     * @return Segment
     */
    public function setSubname($subname)
    {
        $this->subname = $subname;

        return $this;
    }

    /**
     * Get subname
     *
     * @return string
     */
    public function getSubname()
    {
        return $this->subname;
    }
}
