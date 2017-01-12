<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * MenuMenuEntryAssignment
 */
class MenuMenuEntryAssignment extends Audit
{
	public function getDisplayName() {
		return $this->menu->getDisplayName();
	}
	
    /**
     * @var integer
     */
    private $menu;

    /**
     * @var \AppBundle\Entity\MenuEntry
     */
    private $menuEntry;
    
    /**
     * @var integer
     */
    private $orderNumber;


    /**
     * Set menu
     *
     * @param integer $menu
     *
     * @return MenuMenuEntryAssignment
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
     * Set menuEntry
     *
     * @param \AppBundle\Entity\MenuEntry $menuEntry
     *
     * @return MenuMenuEntryAssignment
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
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return MenuMenuEntryAssignment
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
}
