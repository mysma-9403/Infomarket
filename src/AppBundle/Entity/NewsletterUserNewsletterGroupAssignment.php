<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * NewsletterUserNewsletterGroupAssignment
 */
class NewsletterUserNewsletterGroupAssignment extends Audit
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->newsletterGroup->getDisplayName();
	}
	
    /**
     * @var \AppBundle\Entity\NewsletterUser
     */
    private $newsletterUser;

    /**
     * @var \AppBundle\Entity\NewsletterGroup
     */
    private $newsletterGroup;


    /**
     * Set newsletterUser
     *
     * @param \AppBundle\Entity\NewsletterUser $newsletterUser
     *
     * @return NewsletterUserNewsletterGroupAssignment
     */
    public function setNewsletterUser(\AppBundle\Entity\NewsletterUser $newsletterUser = null)
    {
        $this->newsletterUser = $newsletterUser;

        return $this;
    }

    /**
     * Get newsletterUser
     *
     * @return \AppBundle\Entity\NewsletterUser
     */
    public function getNewsletterUser()
    {
        return $this->newsletterUser;
    }

    /**
     * Set newsletterGroup
     *
     * @param \AppBundle\Entity\NewsletterGroup $newsletterGroup
     *
     * @return NewsletterUserNewsletterGroupAssignment
     */
    public function setNewsletterGroup(\AppBundle\Entity\NewsletterGroup $newsletterGroup = null)
    {
        $this->newsletterGroup = $newsletterGroup;

        return $this;
    }

    /**
     * Get newsletterGroup
     *
     * @return \AppBundle\Entity\NewsletterGroup
     */
    public function getNewsletterGroup()
    {
        return $this->newsletterGroup;
    }
}
