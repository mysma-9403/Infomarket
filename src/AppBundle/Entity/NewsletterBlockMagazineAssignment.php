<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * NewsletterBlockMagazineAssignment
 */
class NewsletterBlockMagazineAssignment extends Audit
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->magazine->getDisplayName();
	}
	
    /**
     * @var integer
     */
    private $orderNumber;

    /**
     * @var \AppBundle\Entity\NewsletterBlock
     */
    private $newsletterBlock;

    /**
     * @var \AppBundle\Entity\Magazine
     */
    private $magazine;


    /**
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return NewsletterBlockMagazineAssignment
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

    /**
     * Set newsletterBlock
     *
     * @param \AppBundle\Entity\NewsletterBlock $newsletterBlock
     *
     * @return NewsletterBlockMagazineAssignment
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
     * Set magazine
     *
     * @param \AppBundle\Entity\Magazine $magazine
     *
     * @return NewsletterBlockMagazineAssignment
     */
    public function setMagazine(\AppBundle\Entity\Magazine $magazine = null)
    {
        $this->magazine = $magazine;

        return $this;
    }

    /**
     * Get magazine
     *
     * @return \AppBundle\Entity\Magazine
     */
    public function getMagazine()
    {
        return $this->magazine;
    }
    /**
     * @var string
     */
    private $alternativeName;


    /**
     * Set alternativeName
     *
     * @param string $alternativeName
     *
     * @return NewsletterBlockMagazineAssignment
     */
    public function setAlternativeName($alternativeName)
    {
        $this->alternativeName = $alternativeName;

        return $this;
    }

    /**
     * Get alternativeName
     *
     * @return string
     */
    public function getAlternativeName()
    {
        return $this->alternativeName;
    }
}
