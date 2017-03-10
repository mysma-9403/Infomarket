<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * NewsletterBlockArticleAssignment
 */
class NewsletterBlockArticleAssignment extends Audit
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->article->getDisplayName();
	}
	
    /**
     * @var \AppBundle\Entity\NewsletterBlock
     */
    private $newsletterBlock;

    /**
     * @var \AppBundle\Entity\Article
     */
    private $article;


    /**
     * Set newsletterBlock
     *
     * @param \AppBundle\Entity\NewsletterBlock $newsletterBlock
     *
     * @return NewsletterBlockArticleAssignment
     */
    public function setNewsletterBlock(\AppBundle\Entity\NewsletterBlock $newsletterBlock = null)
    {
        $this->newsletterBlock = $newsletterBlock;

        return $this;
    }

    /**
     * Get newsletterBlock
     *
     * @return \AppBundle\Entity\NewsletterBlock
     */
    public function getNewsletterBlock()
    {
        return $this->newsletterBlock;
    }

    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return NewsletterBlockArticleAssignment
     */
    public function setArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \AppBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
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
     * @return NewsletterBlockArticleAssignment
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
    private $alternativeName;

    /**
     * @var string
     */
    private $alternativeSubname;


    /**
     * Set alternativeName
     *
     * @param string $alternativeName
     *
     * @return NewsletterBlockArticleAssignment
     */
    public function setAlternativeName($alternativeName)
    {
        $this->alternativeName = $alternativeName;

        return $this;
    }

    /**
     * Get alternativeName
     *
     * @return string
     */
    public function getAlternativeName()
    {
        return $this->alternativeName;
    }

    /**
     * Set alternativeSubname
     *
     * @param string $alternativeSubname
     *
     * @return NewsletterBlockArticleAssignment
     */
    public function setAlternativeSubname($alternativeSubname)
    {
        $this->alternativeSubname = $alternativeSubname;

        return $this;
    }

    /**
     * Get alternativeSubname
     *
     * @return string
     */
    public function getAlternativeSubname()
    {
        return $this->alternativeSubname;
    }
    /**
     * @var string
     */
    private $alternativeBrands;


    /**
     * Set alternativeBrands
     *
     * @param string $alternativeBrands
     *
     * @return NewsletterBlockArticleAssignment
     */
    public function setAlternativeBrands($alternativeBrands)
    {
        $this->alternativeBrands = $alternativeBrands;

        return $this;
    }

    /**
     * Get alternativeBrands
     *
     * @return string
     */
    public function getAlternativeBrands()
    {
        return $this->alternativeBrands;
    }
}
