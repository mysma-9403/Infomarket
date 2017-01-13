<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * MenuEntryBranchAssignment
 */
class MenuEntryBranchAssignment extends Audit
{
	public function getDisplayName() {
		return $this->branch->getDisplayName();
	}
	
    /**
     * @var \AppBundle\Entity\MenuEntry
     */
    private $menuEntry;

    /**
     * @var \AppBundle\Entity\Branch
     */
    private $branch;


    /**
     * Set menuEntry
     *
     * @param \AppBundle\Entity\MenuEntry $menuEntry
     *
     * @return MenuEntryBranchAssignment
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
     * Set branch
     *
     * @param \AppBundle\Entity\Branch $branch
     *
     * @return MenuEntryBranchAssignment
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
}
