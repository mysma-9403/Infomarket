<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Image;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Article extends Image {

	const LEFT_LAYOUT = 0;

	const MID_LAYOUT = 1;

	const RIGHT_LAYOUT = 2;

	const BOTTOM_LAYOUT = 3;

	const LARGE_IMAGE = 0;

	const MEDIUM_IMAGE = 1;

	const SMALL_IMAGE = 2;

	public function getDisplayName() {
		$name = parent::getDisplayName();
		if ($this->subname) {
			if ($name == '<empty>')
				$name = $this->subname;
			else
				$name .= ' ' . $this->subname;
		}
		
		return $name;
	}

	public function getUploadPath() {
		return 'uploads/articles/' . $this->getCreatedAt()->format('Y/m/');
	}

	public function validate(ExecutionContextInterface $context, $payload) {
		if ($this->parent == null && $this->name == null) {
			$context->buildViolation('article.name.notnull')->atPath('name')->addViolation();
		}
		
		if ($this->parent) {
			
			if ($this->parent->parent) {
				$context->buildViolation('article.subarticle')->atPath('parent')->addViolation();
			}
			
			if (count($this->articleArticleCategoryAssignments) > 0) {
				$context->buildViolation('subarticle.articleArticleCategoryAssignmentNotEmpty')->atPath(
						'parent')->addViolation();
			}
			
			if (count($this->articleCategoryAssignments) > 0) {
				$context->buildViolation('subarticle.articleCategoryAssignmentNotEmpty')->atPath('parent')->addViolation();
			}
			
			if (count($this->articleBrandAssignments) > 0) {
				$context->buildViolation('subarticle.articleBrandAssignmentNotEmpty')->atPath('parent')->addViolation();
			}
			
			if (count($this->articleTagAssignments) > 0) {
				$context->buildViolation('subarticle.articleTagAssignmentNotEmpty')->atPath('parent')->addViolation();
			}
			
			if (count($this->children) > 0) {
				$context->buildViolation('subarticle.subarticleNotEmpty')->atPath('parent')->addViolation();
			}
		}
	}
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $subname;

    /**
     * @var boolean
     */
    private $showTitle;

    /**
     * @var boolean
     */
    private $infomarket;

    /**
     * @var boolean
     */
    private $infoprodukt;

    /**
     * @var boolean
     */
    private $featured;

    /**
     * @var boolean
     */
    private $archived;

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
     * @var \DateTime
     */
    private $endDate;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $newsletterBlockArticleAssignments;

    /**
     * @var \AppBundle\Entity\Main\User
     */
    private $author;

    /**
     * @var \AppBundle\Entity\Main\Article
     */
    private $parent;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Article
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Set showTitle
     *
     * @param boolean $showTitle
     *
     * @return Article
     */
    public function setShowTitle($showTitle)
    {
        $this->showTitle = $showTitle;

        return $this;
    }

    /**
     * Get showTitle
     *
     * @return boolean
     */
    public function getShowTitle()
    {
        return $this->showTitle;
    }

    /**
     * Set infomarket
     *
     * @param boolean $infomarket
     *
     * @return Article
     */
    public function setInfomarket($infomarket)
    {
        $this->infomarket = $infomarket;

        return $this;
    }

    /**
     * Get infomarket
     *
     * @return boolean
     */
    public function getInfomarket()
    {
        return $this->infomarket;
    }

    /**
     * Set infoprodukt
     *
     * @param boolean $infoprodukt
     *
     * @return Article
     */
    public function setInfoprodukt($infoprodukt)
    {
        $this->infoprodukt = $infoprodukt;

        return $this;
    }

    /**
     * Get infoprodukt
     *
     * @return boolean
     */
    public function getInfoprodukt()
    {
        return $this->infoprodukt;
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
     * @param \AppBundle\Entity\Main\Article $child
     *
     * @return Article
     */
    public function addChild(\AppBundle\Entity\Main\Article $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\Main\Article $child
     */
    public function removeChild(\AppBundle\Entity\Main\Article $child)
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
     * @param \AppBundle\Entity\Assignments\ArticleArticleCategoryAssignment $articleArticleCategoryAssignment
     *
     * @return Article
     */
    public function addArticleArticleCategoryAssignment(\AppBundle\Entity\Assignments\ArticleArticleCategoryAssignment $articleArticleCategoryAssignment)
    {
        $this->articleArticleCategoryAssignments[] = $articleArticleCategoryAssignment;

        return $this;
    }

    /**
     * Remove articleArticleCategoryAssignment
     *
     * @param \AppBundle\Entity\Assignments\ArticleArticleCategoryAssignment $articleArticleCategoryAssignment
     */
    public function removeArticleArticleCategoryAssignment(\AppBundle\Entity\Assignments\ArticleArticleCategoryAssignment $articleArticleCategoryAssignment)
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
     * @param \AppBundle\Entity\Assignments\ArticleCategoryAssignment $articleCategoryAssignment
     *
     * @return Article
     */
    public function addArticleCategoryAssignment(\AppBundle\Entity\Assignments\ArticleCategoryAssignment $articleCategoryAssignment)
    {
        $this->articleCategoryAssignments[] = $articleCategoryAssignment;

        return $this;
    }

    /**
     * Remove articleCategoryAssignment
     *
     * @param \AppBundle\Entity\Assignments\ArticleCategoryAssignment $articleCategoryAssignment
     */
    public function removeArticleCategoryAssignment(\AppBundle\Entity\Assignments\ArticleCategoryAssignment $articleCategoryAssignment)
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
     * @param \AppBundle\Entity\Assignments\ArticleBrandAssignment $articleBrandAssignment
     *
     * @return Article
     */
    public function addArticleBrandAssignment(\AppBundle\Entity\Assignments\ArticleBrandAssignment $articleBrandAssignment)
    {
        $this->articleBrandAssignments[] = $articleBrandAssignment;

        return $this;
    }

    /**
     * Remove articleBrandAssignment
     *
     * @param \AppBundle\Entity\Assignments\ArticleBrandAssignment $articleBrandAssignment
     */
    public function removeArticleBrandAssignment(\AppBundle\Entity\Assignments\ArticleBrandAssignment $articleBrandAssignment)
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
     * @param \AppBundle\Entity\Assignments\ArticleTagAssignment $articleTagAssignment
     *
     * @return Article
     */
    public function addArticleTagAssignment(\AppBundle\Entity\Assignments\ArticleTagAssignment $articleTagAssignment)
    {
        $this->articleTagAssignments[] = $articleTagAssignment;

        return $this;
    }

    /**
     * Remove articleTagAssignment
     *
     * @param \AppBundle\Entity\Assignments\ArticleTagAssignment $articleTagAssignment
     */
    public function removeArticleTagAssignment(\AppBundle\Entity\Assignments\ArticleTagAssignment $articleTagAssignment)
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
     * Add newsletterBlockArticleAssignment
     *
     * @param \AppBundle\Entity\Assignments\NewsletterBlockArticleAssignment $newsletterBlockArticleAssignment
     *
     * @return Article
     */
    public function addNewsletterBlockArticleAssignment(\AppBundle\Entity\Assignments\NewsletterBlockArticleAssignment $newsletterBlockArticleAssignment)
    {
        $this->newsletterBlockArticleAssignments[] = $newsletterBlockArticleAssignment;

        return $this;
    }

    /**
     * Remove newsletterBlockArticleAssignment
     *
     * @param \AppBundle\Entity\Assignments\NewsletterBlockArticleAssignment $newsletterBlockArticleAssignment
     */
    public function removeNewsletterBlockArticleAssignment(\AppBundle\Entity\Assignments\NewsletterBlockArticleAssignment $newsletterBlockArticleAssignment)
    {
        $this->newsletterBlockArticleAssignments->removeElement($newsletterBlockArticleAssignment);
    }

    /**
     * Get newsletterBlockArticleAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewsletterBlockArticleAssignments()
    {
        return $this->newsletterBlockArticleAssignments;
    }

    /**
     * Set author
     *
     * @param \AppBundle\Entity\Main\User $author
     *
     * @return Article
     */
    public function setAuthor(\AppBundle\Entity\Main\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\Main\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\Main\Article $parent
     *
     * @return Article
     */
    public function setParent(\AppBundle\Entity\Main\Article $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Main\Article
     */
    public function getParent()
    {
        return $this->parent;
    }
}
