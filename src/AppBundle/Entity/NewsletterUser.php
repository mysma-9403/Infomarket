<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntity;

/**
 * NewsletterUser
 */
class NewsletterUser extends SimpleEntity
{
    /**
     * @var boolean
     */
    private $subscribed;


    /**
     * Set subscribed
     *
     * @param boolean $subscribed
     *
     * @return NewsletterUser
     */
    public function setSubscribed($subscribed)
    {
        $this->subscribed = $subscribed;

        return $this;
    }

    /**
     * Get subscribed
     *
     * @return boolean
     */
    public function getSubscribed()
    {
        return $this->subscribed;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $newsletterUserNewsletterGroupAssignments;


    /**
     * Add newsletterUserNewsletterGroupAssignment
     *
     * @param \AppBundle\Entity\NewsletterUserNewsletterGroupAssignment $newsletterUserNewsletterGroupAssignment
     *
     * @return NewsletterUser
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $newsletterUserNewsletterPageAssignments;


    /**
     * Add newsletterUserNewsletterPageAssignment
     *
     * @param \AppBundle\Entity\NewsletterUserNewsletterPageAssignment $newsletterUserNewsletterPageAssignment
     *
     * @return NewsletterUser
     */
    public function addNewsletterUserNewsletterPageAssignment(\AppBundle\Entity\NewsletterUserNewsletterPageAssignment $newsletterUserNewsletterPageAssignment)
    {
        $this->newsletterUserNewsletterPageAssignments[] = $newsletterUserNewsletterPageAssignment;

        return $this;
    }

    /**
     * Remove newsletterUserNewsletterPageAssignment
     *
     * @param \AppBundle\Entity\NewsletterUserNewsletterPageAssignment $newsletterUserNewsletterPageAssignment
     */
    public function removeNewsletterUserNewsletterPageAssignment(\AppBundle\Entity\NewsletterUserNewsletterPageAssignment $newsletterUserNewsletterPageAssignment)
    {
        $this->newsletterUserNewsletterPageAssignments->removeElement($newsletterUserNewsletterPageAssignment);
    }

    /**
     * Get newsletterUserNewsletterPageAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewsletterUserNewsletterPageAssignments()
    {
        return $this->newsletterUserNewsletterPageAssignments;
    }
}
