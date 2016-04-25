<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * ArticleCategory
 */
class ArticleCategory extends ImageEntity
{
	
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
