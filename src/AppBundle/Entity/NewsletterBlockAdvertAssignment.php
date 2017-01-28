<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * NewsletterBlockAdvertAssignment
 */
class NewsletterBlockAdvertAssignment extends Audit
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->advert->getDisplayName();
	}
	
    /**
     * @var \AppBundle\Entity\NewsletterBlock
     */
    private $newsletterBlock;

    /**
     * @var \AppBundle\Entity\Advert
     */
    private $advert;


    /**
     * Set newsletterBlock
     *
     * @param \AppBundle\Entity\NewsletterBlock $newsletterBlock
     *
     * @return NewsletterBlockAdvertAssignment
     */
    public function setNewsletterBlock(\AppBundle\Entity\NewsletterBlock $newsletterBlock = null)
    {
        $this->newsletterBlock = $newsletterBlock;

        return $this;
    }

    /**
     * Get newsletterBlock
     *
     * @return \AppBundle\Entity\NewsletterBlock
     */
    public function getNewsletterBlock()
    {
        return $this->newsletterBlock;
    }

    /**
     * Set advert
     *
     * @param \AppBundle\Entity\Advert $advert
     *
     * @return NewsletterBlockAdvertAssignment
     */
    public function setAdvert(\AppBundle\Entity\Advert $advert = null)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \AppBundle\Entity\Advert
     */
    public function getAdvert()
    {
        return $this->advert;
    }
    /**
     * @var integer
     */
    private $orderNumber;


    /**
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return NewsletterBlockAdvertAssignment
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get orderNumber
     *
     * @return integer
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }
}
