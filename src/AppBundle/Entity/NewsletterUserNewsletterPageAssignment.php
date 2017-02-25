<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * NewsletterUserNewsletterPageAssignment
 */
class NewsletterUserNewsletterPageAssignment extends Audit
{
	const WAITING_STATE = 1;
	const SENDING_STATE = 2;
	const SENT_STATE = 3;
	const ERROR_STATE = 4;
	
	public static function getStateName($state) {
		switch($state) {
			case self::WAITING_STATE:
				return 'label.newsletterUserNewsletterPageAssignment.state.waiting';
			case self::SENDING_STATE:
				return 'label.newsletterUserNewsletterPageAssignment.state.sending';
			case self::SENT_STATE:
				return 'label.newsletterUserNewsletterPageAssignment.state.sent';
			case self::ERROR_STATE:
				return 'label.newsletterUserNewsletterPageAssignment.state.error';
			default:
				return '';
		}
	}
	
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
    
    /**
     * @var integer
     */
    private $state;


    /**
     * Set state
     *
     * @param integer $state
     *
     * @return NewsletterUserNewsletterPageAssignment
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }
    /**
     * @var boolean
     */
    private $embedImages;


    /**
     * Set embedImages
     *
     * @param boolean $embedImages
     *
     * @return NewsletterUserNewsletterPageAssignment
     */
    public function setEmbedImages($embedImages)
    {
        $this->embedImages = $embedImages;

        return $this;
    }

    /**
     * Get embedImages
     *
     * @return boolean
     */
    public function getEmbedImages()
    {
        return $this->embedImages;
    }
    /**
     * @var \DateTime
     */
    private $processingTime;


    /**
     * Set processingTime
     *
     * @param \DateTime $processingTime
     *
     * @return NewsletterUserNewsletterPageAssignment
     */
    public function setProcessingTime($processingTime)
    {
        $this->processingTime = $processingTime;

        return $this;
    }

    /**
     * Get processingTime
     *
     * @return \DateTime
     */
    public function getProcessingTime()
    {
        return $this->processingTime;
    }
}
