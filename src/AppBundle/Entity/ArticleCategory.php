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
}
