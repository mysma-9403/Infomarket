<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntityTree;

/**
 * MenuEntry
 */
class MenuEntry extends SimpleEntityTree
{ 
	const FOOTER_MENU = 1;
	
	/**
	 * @var integer
	 */
	private $menu;
	
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
     * Set menu
     *
     * @param integer $menu
     *
     * @return MenuEntry
     */
    public function setMenu($menu)
    {
    	$this->menu = $menu;
    
    	return $this;
    }
    
    /**
     * Get menu
     *
     * @return integer
     */
    public function getMenu()
    {
    	return $this->menu;
    }
    
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
}
