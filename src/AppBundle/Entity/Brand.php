<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * Brand
 */
class Brand extends ImageEntity
{
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/brands/' . substr($this->name, 0, 1);
	}
	
    /**
     * @var string
     */
    private $content;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $brandCategoryAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $products;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->brandCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Brand
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
     * Add brandCategoryAssignment
     *
     * @param \AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment
     *
     * @return Brand
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

    /**
     * Add product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return Brand
     */
    public function addProduct(\AppBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \AppBundle\Entity\Product $product
     */
    public function removeProduct(\AppBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
