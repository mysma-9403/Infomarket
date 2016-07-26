<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * ArticleBrandAssignment
 */
class ArticleBrandAssignment extends Audit
{
    /**
     * @var \AppBundle\Entity\Article
     */
    private $article;

    /**
     * @var \AppBundle\Entity\Brand
     */
    private $brand;


    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return ArticleBrandAssignment
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
     * Set brand
     *
     * @param \AppBundle\Entity\Brand $brand
     *
     * @return ArticleBrandAssignment
     */
    public function setBrand(\AppBundle\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \AppBundle\Entity\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }
}
