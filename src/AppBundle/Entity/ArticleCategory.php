<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * ArticleCategory
 */
class ArticleCategory extends ImageEntity
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Image::getDisplayName()
	 */
	public function getDisplayName() {
		$result = parent::getDisplayName();
		if($this->subname) {
			if($result == '<empty>')
				$result = $this->subname;
			else 
				$result .= ' ' . $this->subname;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Image::getUploadPath()
	 */
	public function getUploadPath()
	{
		return '../web/uploads/article-categories';
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
     * @return ArticleCategory
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
    private $articleArticleCategoryAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articleArticleCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add articleArticleCategoryAssignment
     *
     * @param \AppBundle\Entity\ArticleArticleCategoryAssignment $articleArticleCategoryAssignment
     *
     * @return ArticleCategory
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
     * @var integer
     */
    private $orderNumber;


    /**
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return ArticleCategory
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
    private $subname;


    /**
     * Set subname
     *
     * @param string $subname
     *
     * @return ArticleCategory
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
