<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntityTree;

/**
 * MenuEntry
 */
class MenuEntry extends SimpleEntityTree
{
    /**
     * @var integer
     */
    private $orderNumber;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \AppBundle\Entity\MenuEntry
     */
    private $parent;

    /**
     * @var \AppBundle\Entity\Page
     */
    private $page;

    /**
     * @var \AppBundle\Entity\Link
     */
    private $link;


    
    /**
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return MenuEntry
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get orderNumber
     *
     * @return integer
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return MenuEntry
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add child
     *
     * @param \AppBundle\Entity\MenuEntry $child
     *
     * @return MenuEntry
     */
    public function addChild(\AppBundle\Entity\MenuEntry $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\MenuEntry $child
     */
    public function removeChild(\AppBundle\Entity\MenuEntry $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\MenuEntry $parent
     *
     * @return MenuEntry
     */
    public function setParent(\AppBundle\Entity\MenuEntry $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\MenuEntry
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set page
     *
     * @param \AppBundle\Entity\Page $page
     *
     * @return MenuEntry
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
     * Set link
     *
     * @param \AppBundle\Entity\Link $link
     *
     * @return MenuEntry
     */
    public function setLink(\AppBundle\Entity\Link $link = null)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return \AppBundle\Entity\Link
     */
    public function getLink()
    {
        return $this->link;
    }
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $menuMenuEntryAssignments;


    /**
     * Add menuMenuEntryAssignment
     *
     * @param \AppBundle\Entity\MenuMenuEntryAssignment $menuMenuEntryAssignment
     *
     * @return MenuEntry
     */
    public function addMenuMenuEntryAssignment(\AppBundle\Entity\MenuMenuEntryAssignment $menuMenuEntryAssignment)
    {
        $this->menuMenuEntryAssignments[] = $menuMenuEntryAssignment;

        return $this;
    }

    /**
     * Remove menuMenuEntryAssignment
     *
     * @param \AppBundle\Entity\MenuMenuEntryAssignment $menuMenuEntryAssignment
     */
    public function removeMenuMenuEntryAssignment(\AppBundle\Entity\MenuMenuEntryAssignment $menuMenuEntryAssignment)
    {
        $this->menuMenuEntryAssignments->removeElement($menuMenuEntryAssignment);
    }

    /**
     * Get menuMenuEntryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenuMenuEntryAssignments()
    {
        return $this->menuMenuEntryAssignments;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $menuEntryBranchAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $menuEntryCategoryAssignments;


    /**
     * Add menuEntryBranchAssignment
     *
     * @param \AppBundle\Entity\MenuEntryBranchAssignment $menuEntryBranchAssignment
     *
     * @return MenuEntry
     */
    public function addMenuEntryBranchAssignment(\AppBundle\Entity\MenuEntryBranchAssignment $menuEntryBranchAssignment)
    {
        $this->menuEntryBranchAssignments[] = $menuEntryBranchAssignment;

        return $this;
    }

    /**
     * Remove menuEntryBranchAssignment
     *
     * @param \AppBundle\Entity\MenuEntryBranchAssignment $menuEntryBranchAssignment
     */
    public function removeMenuEntryBranchAssignment(\AppBundle\Entity\MenuEntryBranchAssignment $menuEntryBranchAssignment)
    {
        $this->menuEntryBranchAssignments->removeElement($menuEntryBranchAssignment);
    }

    /**
     * Get menuEntryBranchAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenuEntryBranchAssignments()
    {
        return $this->menuEntryBranchAssignments;
    }

    /**
     * Add menuEntryCategoryAssignment
     *
     * @param \AppBundle\Entity\MenuEntryCategoryAssignment $menuEntryCategoryAssignment
     *
     * @return MenuEntry
     */
    public function addMenuEntryCategoryAssignment(\AppBundle\Entity\MenuEntryCategoryAssignment $menuEntryCategoryAssignment)
    {
        $this->menuEntryCategoryAssignments[] = $menuEntryCategoryAssignment;

        return $this;
    }

    /**
     * Remove menuEntryCategoryAssignment
     *
     * @param \AppBundle\Entity\MenuEntryCategoryAssignment $menuEntryCategoryAssignment
     */
    public function removeMenuEntryCategoryAssignment(\AppBundle\Entity\MenuEntryCategoryAssignment $menuEntryCategoryAssignment)
    {
        $this->menuEntryCategoryAssignments->removeElement($menuEntryCategoryAssignment);
    }

    /**
     * Get menuEntryCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenuEntryCategoryAssignments()
    {
        return $this->menuEntryCategoryAssignments;
    }
}
