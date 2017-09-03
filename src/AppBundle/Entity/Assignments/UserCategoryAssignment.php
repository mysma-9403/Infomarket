<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class UserCategoryAssignment extends Simple {

	public function getDisplayName() {
		return $this->user->getDisplayName();
	}

	/**
	 *
	 * @var \AppBundle\Entity\Main\User
	 */
	private $user;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Category
	 */
	private $category;

	/**
	 * Set user
	 *
	 * @param \AppBundle\Entity\Main\User $user        	
	 *
	 * @return UserCategoryAssignment
	 */
	public function setUser(\AppBundle\Entity\Main\User $user = null) {
		$this->user = $user;
		
		return $this;
	}

	/**
	 * Get user
	 *
	 * @return \AppBundle\Entity\Main\User
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Set category
	 *
	 * @param \AppBundle\Entity\Main\Category $category        	
	 *
	 * @return UserCategoryAssignment
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
