<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntity;

class NewsletterPage extends SimpleEntity
{
	public function getNewsletterCode() {
		$content = $this->newsletterPageTemplate->getContent();
		
		$style = '';
		$blocks = '';
		
		$usedStyles = array();
		
		foreach ($this->newsletterBlocks as $newsletterBlock) {
			$template = $newsletterBlock->getNewsletterBlockTemplate();
			$name = $template->getName();
			if(!in_array($name, $usedStyles)) {
				$usedStyles[] = $name;
				
				$style .= $template->getStyle() . "\r\n";
			}
			
			$blocks .= $newsletterBlock->getNewsletterCode() . "\r\n";
		}
		
		$content = str_replace("{style}", $style, $content);
		$content = str_replace("{blocks}", $blocks, $content);
		
		return $content;
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
}
