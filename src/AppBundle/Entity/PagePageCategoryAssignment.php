<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * PagePageCategoryAssignment
 */
class PagePageCategoryAssignment extends Audit
{
    /**
     * @var \AppBundle\Entity\Page
     */
    private $page;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set page
     *
     * @param \AppBundle\Entity\Page $page
     *
     * @return PagePageCategoryAssignment
     */
    public function setPage(\AppBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \AppBundle\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return PagePageCategoryAssignment
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
    /**
     * @var \AppBundle\Entity\PageCategory
     */
    private $pageCategory;


    /**
     * Set pageCategory
     *
     * @param \AppBundle\Entity\PageCategory $pageCategory
     *
     * @return PagePageCategoryAssignment
     */
    public function setPageCategory(\AppBundle\Entity\PageCategory $pageCategory = null)
    {
        $this->pageCategory = $pageCategory;

        return $this;
    }

    /**
     * Get pageCategory
     *
     * @return \AppBundle\Entity\PageCategory
     */
    public function getPageCategory()
    {
        return $this->pageCategory;
    }
}
