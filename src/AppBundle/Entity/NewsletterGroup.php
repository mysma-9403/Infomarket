<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntity;

/**
 * NewsletterGroup
 */
class NewsletterGroup extends SimpleEntity
{

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $newsletterUserNewsletterGroupAssignments;


    /**
     * Add newsletterUserNewsletterGroupAssignment
     *
     * @param \AppBundle\Entity\NewsletterUserNewsletterGroupAssignment $newsletterUserNewsletterGroupAssignment
     *
     * @return NewsletterGroup
     */
    public function addNewsletterUserNewsletterGroupAssignment(\AppBundle\Entity\NewsletterUserNewsletterGroupAssignment $newsletterUserNewsletterGroupAssignment)
    {
        $this->newsletterUserNewsletterGroupAssignments[] = $newsletterUserNewsletterGroupAssignment;

        return $this;
    }

    /**
     * Remove newsletterUserNewsletterGroupAssignment
     *
     * @param \AppBundle\Entity\NewsletterUserNewsletterGroupAssignment $newsletterUserNewsletterGroupAssignment
     */
    public function removeNewsletterUserNewsletterGroupAssignment(\AppBundle\Entity\NewsletterUserNewsletterGroupAssignment $newsletterUserNewsletterGroupAssignment)
    {
        $this->newsletterUserNewsletterGroupAssignments->removeElement($newsletterUserNewsletterGroupAssignment);
    }

    /**
     * Get newsletterUserNewsletterGroupAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewsletterUserNewsletterGroupAssignments()
    {
        return $this->newsletterUserNewsletterGroupAssignments;
    }
}
