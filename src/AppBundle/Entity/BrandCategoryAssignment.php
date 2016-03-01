<?php

namespace AppBundle\Entity;

/**
 * BrandCategoryAssignment
 */
class BrandCategoryAssignment
{
    /**
     * @var \AppBundle\Entity\Brand
     */
    private $brand;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set brand
     *
     * @param \AppBundle\Entity\Brand $brand
     *
     * @return BrandCategoryAssignment
     */
    public function setBrand(\AppBundle\Entity\Brand $brand)
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
    public function setCategory(\AppBundle\Entity\Category $category)
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
