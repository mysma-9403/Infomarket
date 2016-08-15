<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * ArticleTagAssignment
 */
class ArticleTagAssignment extends Audit
{
    /**
     * @var \AppBundle\Entity\Article
     */
    private $article;

    /**
     * @var \AppBundle\Entity\Tag
     */
    private $tag;


    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return ArticleTagAssignment
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
     * Set tag
     *
     * @param \AppBundle\Entity\Tag $tag
     *
     * @return ArticleTagAssignment
     */
    public function setTag(\AppBundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \AppBundle\Entity\Tag
     */
    public function getTag()
    {
        return $this->tag;
    }
}
