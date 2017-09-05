<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class MenuMenuEntryAssignment extends Simple {

	public function getDisplayName() {
		return $this->menu->getDisplayName();
	}

	/**
	 *
	 * @var integer
	 */
	private $orderNumber;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Menu
	 */
	private $menu;

	/**
	 *
	 * @var \AppBundle\Entity\Main\MenuEntry
	 */
	private $menuEntry;

	/**
	 * Set orderNumber
	 *
	 * @param integer $orderNumber        	
	 *
	 * @return MenuMenuEntryAssignment
	 */
	public function setOrderNumber($orderNumber) {
		$this->orderNumber = $orderNumber;
		
		return $this;
	}

	/**
	 * Get orderNumber
	 *
	 * @return integer
	 */
	public function getOrderNumber() {
		return $this->orderNumber;
	}

	/**
	 * Set menu
	 *
	 * @param \AppBundle\Entity\Main\Menu $menu        	
	 *
	 * @return MenuMenuEntryAssignment
	 */
	public function setMenu(\AppBundle\Entity\Main\Menu $menu = null) {
		$this->menu = $menu;
		
		return $this;
	}

	/**
	 * Get menu
	 *
	 * @return \AppBundle\Entity\Main\Menu
	 */
	public function getMenu() {
		return $this->menu;
	}

	/**
	 * Set menuEntry
	 *
	 * @param \AppBundle\Entity\Main\MenuEntry $menuEntry        	
	 *
	 * @return MenuMenuEntryAssignment
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
}
