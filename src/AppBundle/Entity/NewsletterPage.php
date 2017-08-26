<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

class NewsletterPage extends Audit
{
	
	public function getNewsletterCode() {
		$content = $this->newsletterPageTemplate->getContent();
		
		$styles = $this->newsletterPageTemplate->getStyle();
		$blocks = '';
		
		$usedStyles = array();
		
		if($this->newsletterBlocks) {
			foreach ($this->newsletterBlocks as $newsletterBlock) {
				$template = $newsletterBlock->getNewsletterBlockTemplate();
				$name = $template->getName();
				if(!in_array($name, $usedStyles)) {
					$usedStyles[] = $name;
					
					$styles .= "\r\n" . $template->getStyle();
				}
				
				$blocks .= $newsletterBlock->getNewsletterCode() . "\r\n";
			}
		}
		
		$content = str_replace("{styles}", $styles, $content);
		$content = str_replace("{blocks}", $blocks, $content);
		
		$title = $this->name;
		if($this->subname) $title .= ' ' . $this->subname;
		
		$content = str_replace("{pageTitle}", $title, $content);
		
		return $content;
	}
	
	public function getDisplayName() {
		return $this->getName() . ' ' . $this->getSubname();
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
    private $newsletterBlocks;

    /**
     * @var \AppBundle\Entity\NewsletterPageTemplate
     */
    private $newsletterPageTemplate;


    /**
     * Add newsletterBlock
     *
     * @param \AppBundle\Entity\NewsletterBlock $newsletterBlock
     *
     * @return NewsletterPage
     */
    public function addNewsletterBlock(\AppBundle\Entity\NewsletterBlock $newsletterBlock)
    {
        $this->newsletterBlocks[] = $newsletterBlock;

        return $this;
    }

    /**
     * Remove newsletterBlock
     *
     * @param \AppBundle\Entity\NewsletterBlock $newsletterBlock
     */
    public function removeNewsletterBlock(\AppBundle\Entity\NewsletterBlock $newsletterBlock)
    {
        $this->newsletterBlocks->removeElement($newsletterBlock);
    }

    /**
     * Get newsletterBlocks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewsletterBlocks()
    {
        return $this->newsletterBlocks;
    }

    /**
     * Set newsletterPageTemplate
     *
     * @param \AppBundle\Entity\NewsletterPageTemplate $newsletterPageTemplate
     *
     * @return NewsletterPage
     */
    public function setNewsletterPageTemplate(\AppBundle\Entity\NewsletterPageTemplate $newsletterPageTemplate = null)
    {
        $this->newsletterPageTemplate = $newsletterPageTemplate;

        return $this;
    }

    /**
     * Get newsletterPageTemplate
     *
     * @return \AppBundle\Entity\NewsletterPageTemplate
     */
    public function getNewsletterPageTemplate()
    {
        return $this->newsletterPageTemplate;
    }
    /**
     * @var string
     */
    private $subname;


    /**
     * Set subname
     *
     * @param string $subname
     *
     * @return NewsletterPage
     */
    public function setSubname($subname)
    {
        $this->subname = $subname;

        return $this;
    }

    /**
     * Get subname
     *
     * @return string
     */
    public function getSubname()
    {
        return $this->subname;
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
     * @return NewsletterPage
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->newsletterBlocks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->newsletterUserNewsletterPageAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
