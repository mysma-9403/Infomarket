<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * NewsletterGroup
 */
class NewsletterGroup extends Audit
{
	const INFOMARKET_GROUP = 1;
	const INFOPRODUKT_GROUP = 2;
	
	public function getDisplayName() {
		return $this->getName();
	}
	
	/**
	 * @var string
	 */
	protected $name;
	
	
	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return SimpleEntity
	 */
	public function setName($name)
	{
		$this->name = $name;
	
		return $this;
	}
	
	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->newsletterUserNewsletterGroupAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
