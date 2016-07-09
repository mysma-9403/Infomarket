<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * Brand
 */
class Brand extends ImageEntity
{
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/brands/' . substr($this->name, 0, 1);
	}
	
    /**
     * @var string
     */
    private $content;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categoryAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add categoryAssignment
     *
     * @param \AppBundle\Entity\BrandCategoryAssignment $categoryAssignment
     *
     * @return Brand
     */
    public function addCategoryAssignment(\AppBundle\Entity\BrandCategoryAssignment $categoryAssignment)
    {
        $this->categoryAssignments[] = $categoryAssignment;

        return $this;
    }

    /**
     * Remove categoryAssignment
     *
     * @param \AppBundle\Entity\BrandCategoryAssignment $categoryAssignment
     */
    public function removeCategoryAssignment(\AppBundle\Entity\BrandCategoryAssignment $categoryAssignment)
    {
        $this->categoryAssignments->removeElement($categoryAssignment);
    }

    /**
     * Get categoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoryAssignments()
    {
        return $this->categoryAssignments;
    }
}
