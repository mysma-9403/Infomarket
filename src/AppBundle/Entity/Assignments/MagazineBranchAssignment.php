<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class MagazineBranchAssignment extends Simple {

	public function getDisplayName() {
		return $this->branch->getDisplayName();
	}

	/**
	 *
	 * @var \AppBundle\Entity\Main\Magazine
	 */
	private $magazine;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Branch
	 */
	private $branch;

	/**
	 * Set magazine
	 *
	 * @param \AppBundle\Entity\Main\Magazine $magazine        	
	 *
	 * @return MagazineBranchAssignment
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
	 * Set branch
	 *
	 * @param \AppBundle\Entity\Main\Branch $branch        	
	 *
	 * @return MagazineBranchAssignment
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
