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
}
