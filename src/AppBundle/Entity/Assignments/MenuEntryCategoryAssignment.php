<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class MenuEntryCategoryAssignment extends Simple {

	public function getDisplayName() {
		return $this->category->getDisplayName();
	}

	/**
	 *
	 * @var \AppBundle\Entity\Main\MenuEntry
	 */
	private $menuEntry;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Category
	 */
	private $category;

	/**
	 * Set menuEntry
	 *
	 * @param \AppBundle\Entity\Main\MenuEntry $menuEntry        	
	 *
	 * @return MenuEntryCategoryAssignment
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
	 * Set category
	 *
	 * @param \AppBundle\Entity\Main\Category $category        	
	 *
	 * @return MenuEntryCategoryAssignment
	 */
	public function setCategory(\AppBundle\Entity\Main\Category $category = null) {
		$this->category = $category;
		
		return $this;
	}

	/**
	 * Get category
	 *
	 * @return \AppBundle\Entity\Main\Category
	 */
	public function getCategory() {
		return $this->category;
	}
}
