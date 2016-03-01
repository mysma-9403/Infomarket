<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * Article
 */
class Article extends ImageEntity
{
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/articles';
	}
	
    /**
     * @var string
     */
    private $intro;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \AppBundle\Entity\Branch
     */
    private $branch;

    /**
     * @var \AppBundle\Entity\ArticleCategory
     */
    private $articleCategory;


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
     * Set branch
     *
     * @param \AppBundle\Entity\Branch $branch
     *
     * @return Article
     */
    public function setBranch(\AppBundle\Entity\Branch $branch = null)
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * Get branch
     *
     * @return \AppBundle\Entity\Branch
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * Set articleCategory
     *
     * @param \AppBundle\Entity\ArticleCategory $articleCategory
     *
     * @return Article
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
