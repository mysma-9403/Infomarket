<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntity;

/**
 * Menu
 */
class Menu extends SimpleEntity
{
	const FOOTER_MENU = 1;
	const MAIN_MENU = 2;
	
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $menuMenuEntryAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menuMenuEntryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add menuMenuEntryAssignment
     *
     * @param \AppBundle\Entity\MenuMenuEntryAssignment $menuMenuEntryAssignment
     *
     * @return Menu
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
}
