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
}
