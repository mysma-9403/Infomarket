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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productCategoryAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $brandCategoryAssignments;

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
     * Add brandCategoryAssignment
     *
     * @param \AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment
     *
     * @return Segment
     */
    public function addBrandCategoryAssignment(\AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment)
    {
        $this->brandCategoryAssignments[] = $brandCategoryAssignment;

        return $this;
    }

    /**
     * Remove brandCategoryAssignment
     *
     * @param \AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment
     */
    public function removeBrandCategoryAssignment(\AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment)
    {
        $this->brandCategoryAssignments->removeElement($brandCategoryAssignment);
    }

    /**
     * Get brandCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBrandCategoryAssignments()
    {
        return $this->brandCategoryAssignments;
    }
}
