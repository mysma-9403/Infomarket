<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntity;

/**
 * Branch
 */
class Term extends SimpleEntity
{
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
    private $termCategoryAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->termCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add termCategoryAssignment
     *
     * @param \AppBundle\Entity\TermCategoryAssignment $termCategoryAssignment
     *
     * @return Term
     */
    public function addTermCategoryAssignment(\AppBundle\Entity\TermCategoryAssignment $termCategoryAssignment)
    {
        $this->termCategoryAssignments[] = $termCategoryAssignment;

        return $this;
    }

    /**
     * Remove termCategoryAssignment
     *
     * @param \AppBundle\Entity\TermCategoryAssignment $termCategoryAssignment
     */
    public function removeTermCategoryAssignment(\AppBundle\Entity\TermCategoryAssignment $termCategoryAssignment)
    {
        $this->termCategoryAssignments->removeElement($termCategoryAssignment);
    }

    /**
     * Get termCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTermCategoryAssignments()
    {
        return $this->termCategoryAssignments;
    }
}
