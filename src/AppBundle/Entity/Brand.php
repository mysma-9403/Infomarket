<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * Brand
 */
class Brand extends ImageEntity
{
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return 'uploads/brands/' . substr($this->name, 0, 1);
	}
	
    /**
     * @var string
     */
    private $content;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $brandCategoryAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->brandCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Brand
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
     * Add brandCategoryAssignment
     *
     * @param \AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment
     *
     * @return Brand
     */
    public function addBrandCategoryAssignment(\AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment)
    {
        $this->brandCategoryAssignments[] = $brandCategoryAssignment;

        return $this;
    }

    /**
     * Remove brandCategoryAssignment
     *
     * @param \AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment
     */
    public function removeBrandCategoryAssignment(\AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment)
    {
        $this->brandCategoryAssignments->removeElement($brandCategoryAssignment);
    }

    /**
     * Get brandCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBrandCategoryAssignments()
    {
        return $this->brandCategoryAssignments;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articles;


    /**
     * Add article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Brand
     */
    public function addArticle(\AppBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \AppBundle\Entity\Article $article
     */
    public function removeArticle(\AppBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articleBrandAssignments;


    /**
     * Add articleBrandAssignment
     *
     * @param \AppBundle\Entity\ArticleBrandAssignment $articleBrandAssignment
     *
     * @return Brand
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
     * @var string
     */
    private $www;


    /**
     * Set www
     *
     * @param string $www
     *
     * @return Brand
     */
    public function setWww($www)
    {
        $this->www = $www;

        return $this;
    }

    /**
     * Get www
     *
     * @return string
     */
    public function getWww()
    {
        return $this->www;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $products;


    /**
     * Add product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return Brand
     */
    public function addProduct(\AppBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \AppBundle\Entity\Product $product
     */
    public function removeProduct(\AppBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
