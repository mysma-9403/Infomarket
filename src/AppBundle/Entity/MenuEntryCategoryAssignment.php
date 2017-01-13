<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * MenuEntryCategoryAssignment
 */
class MenuEntryCategoryAssignment extends Audit
{
	public function getDisplayName() {
		return $this->category->getDisplayName();
	}
	
    /**
     * @var \AppBundle\Entity\MenuEntry
     */
    private $menuEntry;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set menuEntry
     *
     * @param \AppBundle\Entity\MenuEntry $menuEntry
     *
     * @return MenuEntryCategoryAssignment
     */
    public function setMenuEntry(\AppBundle\Entity\MenuEntry $menuEntry = null)
    {
        $this->menuEntry = $menuEntry;

        return $this;
    }

    /**
     * Get menuEntry
     *
     * @return \AppBundle\Entity\MenuEntry
     */
    public function getMenuEntry()
    {
        return $this->menuEntry;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return MenuEntryCategoryAssignment
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
