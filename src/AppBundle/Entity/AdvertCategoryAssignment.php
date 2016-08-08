<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * AdvertCategoryAssignment
 */
class AdvertCategoryAssignment extends Audit
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->category->getName();
	}
	
    /**
     * @var \AppBundle\Entity\Advert
     */
    private $advert;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set advert
     *
     * @param \AppBundle\Entity\Advert $advert
     *
     * @return AdvertCategoryAssignment
     */
    public function setAdvert(\AppBundle\Entity\Advert $advert = null)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \AppBundle\Entity\Advert
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return AdvertCategoryAssignment
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
