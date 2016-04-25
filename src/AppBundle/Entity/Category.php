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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $branches;


    /**
     * Add branch
     *
     * @param \AppBundle\Entity\BranchCategoryAssignment $branch
     *
     * @return Category
     */
    public function addBranch(\AppBundle\Entity\BranchCategoryAssignment $branch)
    {
        $this->branches[] = $branch;

        return $this;
    }

    /**
     * Remove branch
     *
     * @param \AppBundle\Entity\BranchCategoryAssignment $branch
     */
    public function removeBranch(\AppBundle\Entity\BranchCategoryAssignment $branch)
    {
        $this->branches->removeElement($branch);
    }

    /**
     * Get branches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBranches()
    {
        return $this->branches;
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
}
