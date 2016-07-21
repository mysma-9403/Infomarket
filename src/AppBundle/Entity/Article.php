<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * Article
 */
class Article extends ImageEntity
{
	const DEFAULT_LEFT_LAYOUT 		= 0;
	const DEFAULT_RIGHT_LAYOUT 		= 1;
	const DEFAULT_ALTERNATE_LAYOUT 	= 2;
	
	const NARROW_LEFT_LAYOUT 		= 3;
	const NARROW_RIGHT_LAYOUT 		= 4;
	const NARROW_ALTERNATE_LAYOUT 	= 5;
	
	const WIDE_LAYOUT 				= 6;
	const WIDE_SMALL_IMAGE_LAYOUT 	= 7;
	
	const COLUMN_2_LAYOUT 			= 10;
	const COLUMN_3_LAYOUT 			= 11;
	const COLUMN_4_LAYOUT 			= 12;
	
	const GRID_2_LAYOUT 			= 20;
	const GRID_3_LAYOUT 			= 21;
	const GRID_4_LAYOUT 			= 22;
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Image::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->name . ' ' . $this->subname;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/articles/' . $this->createdAt->format('Y/m/');
	}
	
	
    /**
     * @var string
     */
    private $subname;

    /**
     * @var boolean
     */
    private $featured;

    /**
     * @var string
     */
    private $intro;

    /**
     * @var string
     */
    private $content;

    /**
     * @var integer
     */
    private $orderNumber;

    /**
     * @var integer
     */
    private $layout;

    /**
     * @var boolean
     */
    private $displaySided;

    /**
     * @var boolean
     */
    private $displayPaginated;

    /**
     * @var \AppBundle\Entity\Article
     */
    private $parent;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articleArticleCategoryAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articleCategoryAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articleBrandAssignments;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articleArticleCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articleCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set subname
     *
     * @param string $subname
     *
     * @return Article
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
     * Set featured
     *
     * @param boolean $featured
     *
     * @return Article
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
     * Set intro
     *
     * @param string $intro
     *
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * Set layout
     *
     * @param integer $layout
     *
     * @return Article
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Get layout
     *
     * @return integer
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set displaySided
     *
     * @param boolean $displaySided
     *
     * @return Article
     */
    public function setDisplaySided($displaySided)
    {
        $this->displaySided = $displaySided;

        return $this;
    }

    /**
     * Get displaySided
     *
     * @return boolean
     */
    public function getDisplaySided()
    {
        return $this->displaySided;
    }

    /**
     * Set displayPaginated
     *
     * @param boolean $displayPaginated
     *
     * @return Article
     */
    public function setDisplayPaginated($displayPaginated)
    {
        $this->displayPaginated = $displayPaginated;

        return $this;
    }

    /**
     * Get displayPaginated
     *
     * @return boolean
     */
    public function getDisplayPaginated()
    {
        return $this->displayPaginated;
    }

    /**
     * Add child
     *
     * @param \AppBundle\Entity\Article $child
     *
     * @return Article
     */
    public function addChild(\AppBundle\Entity\Article $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\Article $child
     */
    public function removeChild(\AppBundle\Entity\Article $child)
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
     * Add articleArticleCategoryAssignment
     *
     * @param \AppBundle\Entity\ArticleArticleCategoryAssignment $articleArticleCategoryAssignment
     *
     * @return Article
     */
    public function addArticleArticleCategoryAssignment(\AppBundle\Entity\ArticleArticleCategoryAssignment $articleArticleCategoryAssignment)
    {
        $this->articleArticleCategoryAssignments[] = $articleArticleCategoryAssignment;

        return $this;
    }

    /**
     * Remove articleArticleCategoryAssignment
     *
     * @param \AppBundle\Entity\ArticleArticleCategoryAssignment $articleArticleCategoryAssignment
     */
    public function removeArticleArticleCategoryAssignment(\AppBundle\Entity\ArticleArticleCategoryAssignment $articleArticleCategoryAssignment)
    {
        $this->articleArticleCategoryAssignments->removeElement($articleArticleCategoryAssignment);
    }

    /**
     * Get articleArticleCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticleArticleCategoryAssignments()
    {
        return $this->articleArticleCategoryAssignments;
    }

    /**
     * Add articleCategoryAssignment
     *
     * @param \AppBundle\Entity\ArticleCategoryAssignment $articleCategoryAssignment
     *
     * @return Article
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
     * Set parent
     *
     * @param \AppBundle\Entity\Article $parent
     *
     * @return Article
     */
    public function setParent(\AppBundle\Entity\Article $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Article
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add articleBrandAssignment
     *
     * @param \AppBundle\Entity\ArticleBrandAssignment $articleBrandAssignment
     *
     * @return Article
     */
    public function addArticleBrandAssignment(\AppBundle\Entity\ArticleBrandAssignment $articleBrandAssignment)
    {
        $this->articleBrandAssignments[] = $articleBrandAssignment;

        return $this;
    }

    /**
     * Remove articleBrandAssignment
     *
     * @param \AppBundle\Entity\ArticleBrandAssignment $articleBrandAssignment
     */
    public function removeArticleBrandAssignment(\AppBundle\Entity\ArticleBrandAssignment $articleBrandAssignment)
    {
        $this->articleBrandAssignments->removeElement($articleBrandAssignment);
    }

    /**
     * Get articleBrandAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticleBrandAssignments()
    {
        return $this->articleBrandAssignments;
    }
}
