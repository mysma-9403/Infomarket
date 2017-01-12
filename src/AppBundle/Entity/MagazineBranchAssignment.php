<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * MagazineBranchAssignment
 */
class MagazineBranchAssignment extends Audit
{
	public function getDisplayName() {
		return $this->branch->getDisplayName();
	}
	
    /**
     * @var \AppBundle\Entity\Magazine
     */
    private $magazine;

    /**
     * @var \AppBundle\Entity\Branch
     */
    private $branch;


    /**
     * Set magazine
     *
     * @param \AppBundle\Entity\Magazine $magazine
     *
     * @return MagazineBranchAssignment
     */
    public function setMagazine(\AppBundle\Entity\Magazine $magazine = null)
    {
        $this->magazine = $magazine;

        return $this;
    }

    /**
     * Get magazine
     *
     * @return \AppBundle\Entity\Magazine
     */
    public function getMagazine()
    {
        return $this->magazine;
    }

    /**
     * Set branch
     *
     * @param \AppBundle\Entity\Branch $branch
     *
     * @return MagazineBranchAssignment
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
