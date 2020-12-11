<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class AdvertCategoryAssignment extends Simple {

	public function getDisplayName() {
		return $this->category->getDisplayName();
	}

	/**
	 *
	 * @var \AppBundle\Entity\Main\Advert
	 */
	private $advert;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Category
	 */
	private $category;

	/**
	 * Set advert
	 *
	 * @param \AppBundle\Entity\Main\Advert $advert        	
	 *
	 * @return AdvertCategoryAssignment
	 */
	public function setAdvert(\AppBundle\Entity\Main\Advert $advert = null) {
		$this->advert = $advert;
		
		return $this;
	}

	/**
	 * Get advert
	 *
	 * @return \AppBundle\Entity\Main\Advert
	 */
	public function getAdvert() {
		return $this->advert;
	}

	/**
	 * Set category
	 *
	 * @param \AppBundle\Entity\Main\Category $category        	
	 *
	 * @return AdvertCategoryAssignment
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
