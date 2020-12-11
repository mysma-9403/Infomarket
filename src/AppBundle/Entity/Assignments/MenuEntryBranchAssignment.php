<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class MenuEntryBranchAssignment extends Simple {

	public function getDisplayName() {
		return $this->branch->getDisplayName();
	}

	/**
	 *
	 * @var \AppBundle\Entity\Main\MenuEntry
	 */
	private $menuEntry;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Branch
	 */
	private $branch;

	/**
	 * Set menuEntry
	 *
	 * @param \AppBundle\Entity\Main\MenuEntry $menuEntry        	
	 *
	 * @return MenuEntryBranchAssignment
	 */
	public function setMenuEntry(\AppBundle\Entity\Main\MenuEntry $menuEntry = null) {
		$this->menuEntry = $menuEntry;
		
		return $this;
	}

	/**
	 * Get menuEntry
	 *
	 * @return \AppBundle\Entity\Main\MenuEntry
	 */
	public function getMenuEntry() {
		return $this->menuEntry;
	}

	/**
	 * Set branch
	 *
	 * @param \AppBundle\Entity\Main\Branch $branch        	
	 *
	 * @return MenuEntryBranchAssignment
	 */
	public function setBranch(\AppBundle\Entity\Main\Branch $branch = null) {
		$this->branch = $branch;
		
		return $this;
	}

	/**
	 * Get branch
	 *
	 * @return \AppBundle\Entity\Main\Branch
	 */
	public function getBranch() {
		return $this->branch;
	}
}
