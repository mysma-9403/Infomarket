<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * BranchCategoryAssignment
 */
class BranchCategoryAssignment extends Audit
{
    /**
     * @var \AppBundle\Entity\Branch
     */
    private $branch;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set branch
     *
     * @param \AppBundle\Entity\Branch $branch
     *
     * @return BranchCategoryAssignment
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
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return BranchCategoryAssignment
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
