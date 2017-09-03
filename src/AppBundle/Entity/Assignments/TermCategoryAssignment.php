<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class TermCategoryAssignment extends Simple {

	public function getDisplayName() {
		return $this->category->getDisplayName();
	}

	/**
	 *
	 * @var \AppBundle\Entity\Main\Term
	 */
	private $term;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Category
	 */
	private $category;

	/**
	 * Set term
	 *
	 * @param \AppBundle\Entity\Main\Term $term        	
	 *
	 * @return TermCategoryAssignment
	 */
	public function setTerm(\AppBundle\Entity\Main\Term $term = null) {
		$this->term = $term;
		
		return $this;
	}

	/**
	 * Get term
	 *
	 * @return \AppBundle\Entity\Main\Term
	 */
	public function getTerm() {
		return $this->term;
	}

	/**
	 * Set category
	 *
	 * @param \AppBundle\Entity\Main\Category $category        	
	 *
	 * @return TermCategoryAssignment
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
