<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * NewsletterUserNewsletterPageAssignment
 */
class NewsletterUserNewsletterPageAssignment extends Audit
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->newsletterPage->getDisplayName();
	}
	
    /**
     * @var \AppBundle\Entity\NewsletterUser
     */
    private $newsletterUser;

    /**
     * @var \AppBundle\Entity\NewsletterPage
     */
    private $newsletterPage;


    /**
     * Set newsletterUser
     *
     * @param \AppBundle\Entity\NewsletterUser $newsletterUser
     *
     * @return NewsletterUserNewsletterPageAssignment
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
     * Set newsletterPage
     *
     * @param \AppBundle\Entity\NewsletterPage $newsletterPage
     *
     * @return NewsletterUserNewsletterPageAssignment
     */
    public function setNewsletterPage(\AppBundle\Entity\NewsletterPage $newsletterPage = null)
    {
        $this->newsletterPage = $newsletterPage;

        return $this;
    }

    /**
     * Get newsletterPage
     *
     * @return \AppBundle\Entity\NewsletterPage
     */
    public function getNewsletterPage()
    {
        return $this->newsletterPage;
    }
}
