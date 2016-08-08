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
	
	public function getDefaultChildCategory() {
		
		foreach ($this->getChildren() as $child) {
			if($child->getPublished())
				return $child;
		}
		
		return null;
	}
	
    /**
     * @var string
     */
    private $subname;

    /**
     * @var integer
     */
    private $orderNumber;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var string
     */
    private $featuredImage;

    /**
     * @var boolean
     */
    private $featured;

    /**
     * @var boolean
     */
    private $preleaf;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articleCategoryAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $branchCategoryAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $brandCategoryAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productCategoryAssignments;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articleCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->branchCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->brandCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->productCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set featuredImage
     *
     * @param string $featuredImage
     *
     * @return Category
     */
    public function setFeaturedImage($featuredImage)
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    /**
     * Get featuredImage
     *
     * @return string
     */
    public function getFeaturedImage()
    {
        return $this->featuredImage;
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
     * Add articleCategoryAssignment
     *
     * @param \AppBundle\Entity\ArticleCategoryAssignment $articleCategoryAssignment
     *
     * @return Category
     */
    public function addArticleCategoryAssignment(\AppBundle\Entity\ArticleCategoryAssignment $articleCategoryAssignment)
    {
        $this->articleCategoryAssignments[] = $articleCategoryAssignment;

        return $this;
    }

    /**
     * Remove articleCategoryAssignment
     *
     * @param \AppBundle\Entity\ArticleCategoryAssignment $articleCategoryAssignment
     */
    public function removeArticleCategoryAssignment(\AppBundle\Entity\ArticleCategoryAssignment $articleCategoryAssignment)
    {
        $this->articleCategoryAssignments->removeElement($articleCategoryAssignment);
    }

    /**
     * Get articleCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticleCategoryAssignments()
    {
        return $this->articleCategoryAssignments;
    }

    /**
     * Add branchCategoryAssignment
     *
     * @param \AppBundle\Entity\BranchCategoryAssignment $branchCategoryAssignment
     *
     * @return Category
     */
    public function addBranchCategoryAssignment(\AppBundle\Entity\BranchCategoryAssignment $branchCategoryAssignment)
    {
        $this->branchCategoryAssignments[] = $branchCategoryAssignment;

        return $this;
    }

    /**
     * Remove branchCategoryAssignment
     *
     * @param \AppBundle\Entity\BranchCategoryAssignment $branchCategoryAssignment
     */
    public function removeBranchCategoryAssignment(\AppBundle\Entity\BranchCategoryAssignment $branchCategoryAssignment)
    {
        $this->branchCategoryAssignments->removeElement($branchCategoryAssignment);
    }

    /**
     * Get branchCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBranchCategoryAssignments()
    {
        return $this->branchCategoryAssignments;
    }

    /**
     * Add brandCategoryAssignment
     *
     * @param \AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment
     *
     * @return Category
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
     * Add productCategoryAssignment
     *
     * @param \AppBundle\Entity\ProductCategoryAssignment $productCategoryAssignment
     *
     * @return Category
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
     * @var \AppBundle\Entity\Magazine
     */
    private $magazine;


    /**
     * Set magazine
     *
     * @param \AppBundle\Entity\Magazine $magazine
     *
     * @return Category
     */
    public function setMagazine(\AppBundle\Entity\Magazine $magazine = null)
    {
        $this->magazine = $magazine;

        return $this;
    }

    /**
     * Get magazine
     *
     * @return \AppBundle\Entity\Magazine
     */
    public function getMagazine()
    {
        return $this->magazine;
    }
}
