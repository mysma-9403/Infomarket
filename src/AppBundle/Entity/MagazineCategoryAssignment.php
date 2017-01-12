<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * MagazineCategoryAssignment
 */
class MagazineCategoryAssignment extends Audit
{
	public function getDisplayName() {
		return $this->category->getDisplayName();
	}
	
    /**
     * @var \AppBundle\Entity\Magazine
     */
    private $magazine;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set magazine
     *
     * @param \AppBundle\Entity\Magazine $magazine
     *
     * @return MagazineCategoryAssignment
     */
    public function setMagazine(\AppBundle\Entity\Magazine $magazine = null)
    {
        $this->magazine = $magazine;

        return $this;
    }

    /**
     * Get magazine
     *
     * @return \AppBundle\Entity\Magazine
     */
    public function getMagazine()
    {
        return $this->magazine;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return MagazineCategoryAssignment
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
