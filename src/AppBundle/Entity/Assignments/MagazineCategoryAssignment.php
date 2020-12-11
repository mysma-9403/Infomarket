<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class MagazineCategoryAssignment extends Simple {

	public function getDisplayName() {
		return $this->category->getDisplayName();
	}

	/**
	 *
	 * @var \AppBundle\Entity\Main\Magazine
	 */
	private $magazine;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Category
	 */
	private $category;

	/**
	 * Set magazine
	 *
	 * @param \AppBundle\Entity\Main\Magazine $magazine        	
	 *
	 * @return MagazineCategoryAssignment
	 */
	public function setMagazine(\AppBundle\Entity\Main\Magazine $magazine = null) {
		$this->magazine = $magazine;
		
		return $this;
	}

	/**
	 * Get magazine
	 *
	 * @return \AppBundle\Entity\Main\Magazine
	 */
	public function getMagazine() {
		return $this->magazine;
	}

	/**
	 * Set category
	 *
	 * @param \AppBundle\Entity\Main\Category $category        	
	 *
	 * @return MagazineCategoryAssignment
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
