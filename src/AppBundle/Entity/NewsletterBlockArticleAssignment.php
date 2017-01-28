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
}
