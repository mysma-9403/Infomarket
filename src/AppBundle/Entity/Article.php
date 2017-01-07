<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Article
 */
class Article extends ImageEntity
{
	const LEFT_LAYOUT = 0;
	const MID_LAYOUT = 1;
	const RIGHT_LAYOUT = 2;
	const BOTTOM_LAYOUT = 3;
	
	const LARGE_IMAGE = 0;
	const MEDIUM_IMAGE = 1;
	const SMALL_IMAGE = 2;
	
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
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/articles/' . $this->createdAt->format('Y/m/');
	}
	
	/**
	 * 
	 * @param ExecutionContextInterface $context
	 * @param unknown $payload
	 */
	public function validate(ExecutionContextInterface $context, $payload)
	{
		if ($this->parent == null && $this->name == null) {
			$context->buildViolation('article.name.notnull')
				->atPath('name')
				->addViolation();
        }
        
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
     * @var integer
     */
    private $page;

    /**
     * @var integer
     */
    private $orderNumber;

    /**
     * @var integer
     */
    private $layout;

    /**
     * @var integer
     */
    private $imageSize;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $intro;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articleTagAssignments;

    /**
     * @var \AppBundle\Entity\Article
     */
    private $parent;

    /**
     * @var \AppBundle\Entity\User
     */
    private $author;


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
     * Set page
     *
     * @param integer $page
     *
     * @return Article
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return integer
     */
    public function getPage()
    {
        return $this->page;
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
     * Set imageSize
     *
     * @param integer $imageSize
     *
     * @return Article
     */
    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    /**
     * Get imageSize
     *
     * @return integer
     */
    public function getImageSize()
    {
        return $this->imageSize;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Article
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
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

    /**
     * Add articleTagAssignment
     *
     * @param \AppBundle\Entity\ArticleTagAssignment $articleTagAssignment
     *
     * @return Article
     */
    public function addArticleTagAssignment(\AppBundle\Entity\ArticleTagAssignment $articleTagAssignment)
    {
        $this->articleTagAssignments[] = $articleTagAssignment;

        return $this;
    }

    /**
     * Remove articleTagAssignment
     *
     * @param \AppBundle\Entity\ArticleTagAssignment $articleTagAssignment
     */
    public function removeArticleTagAssignment(\AppBundle\Entity\ArticleTagAssignment $articleTagAssignment)
    {
        $this->articleTagAssignments->removeElement($articleTagAssignment);
    }

    /**
     * Get articleTagAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticleTagAssignments()
    {
        return $this->articleTagAssignments;
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
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     *
     * @return Article
     */
    public function setAuthor(\AppBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }
    /**
     * @var \DateTime
     */
    private $endDate;


    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Article
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
    /**
     * @var boolean
     */
    private $archived;


    /**
     * Set archived
     *
     * @param boolean $archived
     *
     * @return Article
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * Get archived
     *
     * @return boolean
     */
    public function getArchived()
    {
        return $this->archived;
    }
}
