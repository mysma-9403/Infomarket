<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntity;

class NewsletterPage extends SimpleEntity
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
		$result = parent::getDisplayName();
		if($this->subname) {
			if($result == '<empty>')
				$result = $this->subname;
				else
					$result .= ' ' . $this->subname;
		}
	
		return $result;
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
}
