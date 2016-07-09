<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * ArticleArticleCategoryAssignment
 */
class ArticleArticleCategoryAssignment extends Audit
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->articleCategory->getName();
	}
	
    /**
     * @var \AppBundle\Entity\Article
     */
    private $article;

    /**
     * @var \AppBundle\Entity\ArticleCategory
     */
    private $articleCategory;


    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return ArticleArticleCategoryAssignment
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
     * Set articleCategory
     *
     * @param \AppBundle\Entity\ArticleCategory $articleCategory
     *
     * @return ArticleArticleCategoryAssignment
     */
    public function setArticleCategory(\AppBundle\Entity\ArticleCategory $articleCategory = null)
    {
        $this->articleCategory = $articleCategory;

        return $this;
    }

    /**
     * Get articleCategory
     *
     * @return \AppBundle\Entity\ArticleCategory
     */
    public function getArticleCategory()
    {
        return $this->articleCategory;
    }
}
