<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * TermCategoryAssignment
 */
class TermCategoryAssignment extends Audit
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->category->getDisplayName();
	}
	
    /**
     * @var \AppBundle\Entity\Term
     */
    private $term;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set term
     *
     * @param \AppBundle\Entity\Term $term
     *
     * @return TermCategoryAssignment
     */
    public function setTerm(\AppBundle\Entity\Term $term = null)
    {
        $this->term = $term;

        return $this;
    }

    /**
     * Get term
     *
     * @return \AppBundle\Entity\Term
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return TermCategoryAssignment
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
