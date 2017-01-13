<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * Branch
 */
class Branch extends ImageEntity
{
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/branches';
	}
	
    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var integer
     */
    private $orderNumber;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $branchCategoryAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->branchCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Branch
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Branch
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return Branch
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return Branch
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get orderNumber
     *
     * @return integer
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Add branchCategoryAssignment
     *
     * @param \AppBundle\Entity\BranchCategoryAssignment $branchCategoryAssignment
     *
     * @return Branch
     */
    public function addBranchCategoryAssignment(\AppBundle\Entity\BranchCategoryAssignment $branchCategoryAssignment)
    {
        $this->branchCategoryAssignments[] = $branchCategoryAssignment;

        return $this;
    }

    /**
     * Remove branchCategoryAssignment
     *
     * @param \AppBundle\Entity\BranchCategoryAssignment $branchCategoryAssignment
     */
    public function removeBranchCategoryAssignment(\AppBundle\Entity\BranchCategoryAssignment $branchCategoryAssignment)
    {
        $this->branchCategoryAssignments->removeElement($branchCategoryAssignment);
    }

    /**
     * Get branchCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBranchCategoryAssignments()
    {
        return $this->branchCategoryAssignments;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $magazineBranchAssignments;


    /**
     * Add magazineBranchAssignment
     *
     * @param \AppBundle\Entity\MagazineBranchAssignment $magazineBranchAssignment
     *
     * @return Branch
     */
    public function addMagazineBranchAssignment(\AppBundle\Entity\MagazineBranchAssignment $magazineBranchAssignment)
    {
        $this->magazineBranchAssignments[] = $magazineBranchAssignment;

        return $this;
    }

    /**
     * Remove magazineBranchAssignment
     *
     * @param \AppBundle\Entity\MagazineBranchAssignment $magazineBranchAssignment
     */
    public function removeMagazineBranchAssignment(\AppBundle\Entity\MagazineBranchAssignment $magazineBranchAssignment)
    {
        $this->magazineBranchAssignments->removeElement($magazineBranchAssignment);
    }

    /**
     * Get magazineBranchAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMagazineBranchAssignments()
    {
        return $this->magazineBranchAssignments;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $menuEntryBranchAssignments;


    /**
     * Add menuEntryBranchAssignment
     *
     * @param \AppBundle\Entity\MenuEntryBranchAssignment $menuEntryBranchAssignment
     *
     * @return Branch
     */
    public function addMenuEntryBranchAssignment(\AppBundle\Entity\MenuEntryBranchAssignment $menuEntryBranchAssignment)
    {
        $this->menuEntryBranchAssignments[] = $menuEntryBranchAssignment;

        return $this;
    }

    /**
     * Remove menuEntryBranchAssignment
     *
     * @param \AppBundle\Entity\MenuEntryBranchAssignment $menuEntryBranchAssignment
     */
    public function removeMenuEntryBranchAssignment(\AppBundle\Entity\MenuEntryBranchAssignment $menuEntryBranchAssignment)
    {
        $this->menuEntryBranchAssignments->removeElement($menuEntryBranchAssignment);
    }

    /**
     * Get menuEntryBranchAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenuEntryBranchAssignments()
    {
        return $this->menuEntryBranchAssignments;
    }
}
