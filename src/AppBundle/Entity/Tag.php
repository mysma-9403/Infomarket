<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntity;

/**
 * Tag
 */
class Tag extends SimpleEntity
{	
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articleTagAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articleTagAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add articleTagAssignment
     *
     * @param \AppBundle\Entity\ArticleTagAssignment $articleTagAssignment
     *
     * @return Tag
     */
    public function addArticleTagAssignment(\AppBundle\Entity\ArticleTagAssignment $articleTagAssignment)
    {
        $this->articleTagAssignments[] = $articleTagAssignment;

        return $this;
    }

    /**
     * Remove articleTagAssignment
     *
     * @param \AppBundle\Entity\ArticleTagAssignment $articleTagAssignment
     */
    public function removeArticleTagAssignment(\AppBundle\Entity\ArticleTagAssignment $articleTagAssignment)
    {
        $this->articleTagAssignments->removeElement($articleTagAssignment);
    }

    /**
     * Get articleTagAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticleTagAssignments()
    {
        return $this->articleTagAssignments;
    }
}
