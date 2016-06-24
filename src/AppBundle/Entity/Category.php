<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageTree;

/**
 * Category
 */
class Category extends ImageTree
{
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/categories';
	}
	
    /**
     * @var string
     */
    private $content;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $parent;

    /**
     * @var boolean
     */
    private $featured;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Category
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
     * Add child
     *
     * @param \AppBundle\Entity\Category $child
     *
     * @return Category
     */
    public function addChild(\AppBundle\Entity\Category $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\Category $child
     */
    public function removeChild(\AppBundle\Entity\Category $child)
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
     * @param \AppBundle\Entity\Category $parent
     *
     * @return Category
     */
    public function setParent(\AppBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set featured
     *
     * @param boolean $featured
     *
     * @return Category
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
     * @var string
     */
    private $icon;


    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return Category
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }
    /**
     * @var boolean
     */
    private $preleaf;


    /**
     * Set preleaf
     *
     * @param boolean $preleaf
     *
     * @return Category
     */
    public function setPreleaf($preleaf)
    {
        $this->preleaf = $preleaf;

        return $this;
    }

    /**
     * Get preleaf
     *
     * @return boolean
     */
    public function getPreleaf()
    {
        return $this->preleaf;
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
     * @return Category
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
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $branchAssignments;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $brandAssignments;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productAssignments;

    /**
     * Add branchAssignment
     *
     * @param \AppBundle\Entity\BranchCategoryAssignment $branchAssignment
     *
     * @return Category
     */
    public function addBranchAssignment(\AppBundle\Entity\BranchCategoryAssignment $branchAssignment)
    {
        $this->branchAssignments[] = $branchAssignment;

        return $this;
    }

    /**
     * Remove branchAssignment
     *
     * @param \AppBundle\Entity\BranchCategoryAssignment $branchAssignment
     */
    public function removeBranchAssignment(\AppBundle\Entity\BranchCategoryAssignment $branchAssignment)
    {
        $this->branchAssignments->removeElement($branchAssignment);
    }

    /**
     * Get branchAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBranchAssignments()
    {
        return $this->branchAssignments;
    }

    /**
     * Add brandAssignment
     *
     * @param \AppBundle\Entity\BrandCategoryAssignment $brandAssignment
     *
     * @return Category
     */
    public function addBrandAssignment(\AppBundle\Entity\BrandCategoryAssignment $brandAssignment)
    {
        $this->brandAssignments[] = $brandAssignment;

        return $this;
    }

    /**
     * Remove brandAssignment
     *
     * @param \AppBundle\Entity\BrandCategoryAssignment $brandAssignment
     */
    public function removeBrandAssignment(\AppBundle\Entity\BrandCategoryAssignment $brandAssignment)
    {
        $this->brandAssignments->removeElement($brandAssignment);
    }

    /**
     * Get brandAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBrandAssignments()
    {
        return $this->brandAssignments;
    }

    /**
     * Add productAssignment
     *
     * @param \AppBundle\Entity\ProductCategoryAssignment $productAssignment
     *
     * @return Category
     */
    public function addProductAssignment(\AppBundle\Entity\ProductCategoryAssignment $productAssignment)
    {
        $this->productAssignments[] = $productAssignment;

        return $this;
    }

    /**
     * Remove productAssignment
     *
     * @param \AppBundle\Entity\ProductCategoryAssignment $productAssignment
     */
    public function removeProductAssignment(\AppBundle\Entity\ProductCategoryAssignment $productAssignment)
    {
        $this->productAssignments->removeElement($productAssignment);
    }

    /**
     * Get productAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductAssignments()
    {
        return $this->productAssignments;
    }
    /**
     * @var integer
     */
    private $orderNumber;


    /**
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return Category
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
     * @var string
     */
    private $slug;


    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
