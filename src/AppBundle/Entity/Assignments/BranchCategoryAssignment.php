<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class BranchCategoryAssignment extends Simple {

	public function getDisplayName() {
		return $this->category->getDisplayName();
	}

	/**
	 *
	 * @var \AppBundle\Entity\Main\Branch
	 */
	private $branch;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Category
	 */
	private $category;

	/**
	 * Set branch
	 *
	 * @param \AppBundle\Entity\Main\Branch $branch        	
	 *
	 * @return BranchCategoryAssignment
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

	/**
	 * Set category
	 *
	 * @param \AppBundle\Entity\Main\Category $category        	
	 *
	 * @return BranchCategoryAssignment
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
