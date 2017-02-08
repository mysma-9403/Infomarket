<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntity;

class NewsletterBlock extends SimpleEntity
{
	public function getNewsletterCode() {
		$content = $this->newsletterBlockTemplate->getContent();
	
		$adverts = '';
		$articles = '';
		$magazines = '';
		
		foreach ($this->newsletterBlockAdvertAssignments as $newsletterBlockAdvertAssignment) {
			$advert = $newsletterBlockAdvertAssignment->getAdvert();
			
			$entryContent = $this->newsletterBlockTemplate->getAdvertContent();
			
			$entryContent = str_replace("{advertId}", $advert->getId(), $entryContent);
			$entryContent = str_replace("{advertName}", $advert->getName(), $entryContent);
			$entryContent = str_replace("{advertImage}", $advert->getImage(), $entryContent);
			
			$adverts .= $entryContent . "\r\n";
		}
		
		
		foreach($this->newsletterBlockArticleAssignments as $newsletterBlockArticleAssignment) {
			$article = $newsletterBlockArticleAssignment->getArticle();
				
			$entryContent = $this->newsletterBlockTemplate->getArticleContent();
				
			$entryContent = str_replace("{articleId}", $article->getId(), $entryContent);
			$entryContent = str_replace("{articleName}", $article->getName(), $entryContent);
			$entryContent = str_replace("{articleSubname}", $article->getSubname(), $entryContent);
			$entryContent = str_replace("{articleImage}", $article->getImage(), $entryContent);
			$entryContent = str_replace("{articleIntro}", $article->getIntro(), $entryContent);
				
			if($article->getArticleBrandAssignments()) {
				$brands = '';
				foreach($article->getArticleBrandAssignments() as $articleBrandAssignment) {
					if($brands) {
						$brands .= ', ' . $articleBrandAssignment->getBrand()->getName();
					} else {
						$brands = $articleBrandAssignment->getBrand()->getName();
					}
				}
				$entryContent = str_replace("{articleBrands}", $brands, $entryContent);
			}
				
			if($article->getArticleCategoryAssignments()) {
				foreach($article->getArticleCategoryAssignments() as $articleCategoryAssignment) {
					$entryContent = str_replace("{categoryId}", $articleCategoryAssignment->getCategory()->getId(), $entryContent);
					break;
				}
			}
				
			$articles .= $entryContent . "\r\n";
		}
		
		foreach ($this->newsletterBlockMagazineAssignments as $newsletterBlockMagazineAssignment) {
			$magazine = $newsletterBlockMagazineAssignment->getMagazine();
				
			$entryContent = $this->newsletterBlockTemplate->getMagazineContent();
				
			$entryContent = str_replace("{magazineId}", $magazine->getId(), $entryContent);
			$entryContent = str_replace("{magazineName}", $magazine->getName(), $entryContent);
			$entryContent = str_replace("{magazineImage}", $magazine->getImage(), $entryContent);
				
			$magazines .= $entryContent . "\r\n";
		}
		
		$content = str_replace("{adverts}", $adverts, $content);
		$content = str_replace("{articles}", $articles, $content);
		$content = str_replace("{magazines}", $magazines, $content);
		
		
		$content = str_replace("{blockName}", $this->name, $content);
		$content = str_replace("{blockSubname}", $this->subname, $content);
		
		
		if($adverts != '') {
			$advertsCount = count($this->newsletterBlockAdvertAssignments);
			if($advertsCount < 1) $advertsCount = 1;
			$advertImageWidth = 600 / $advertsCount - 10;
			$advertImageHeight = $advertImageWidth * $this->getYAdvertRatio() / $this->getXAdvertRatio();
			$content = str_replace("{advertImageWidth}", $advertImageWidth, $content);
			$content = str_replace("{advertImageHeight}", $advertImageHeight, $content);
		}
		
		if($articles != '') {
			$articlesCount = count($this->newsletterBlockArticleAssignments);
			if($articlesCount < 1) $articlesCount = 1;
			$articleImageWidth = 600 / $articlesCount - 10;
			$articleImageHeight = $articleImageWidth * $this->getYArticleRatio() / $this->getXArticleRatio();
			$content = str_replace("{articleImageWidth}", $articleImageWidth, $content);
			$content = str_replace("{articleImageHeight}", $articleImageHeight, $content);
		}
		
		if($magazines != '') {
			$magazinesCount = count($this->newsletterBlockMagazineAssignments);
			if($magazinesCount < 1) $magazinesCount = 1;
			
			$magazineImageWidth = 600 / $magazinesCount - 10;
			$magazineImageHeight = $magazineImageWidth * $this->getYMagazineRatio() / $this->getXMagazineRatio();
			
			$paddedMagazineImageWidth = $magazineImageWidth - 2*$this->getMagazinePadding();
			$paddedMagazineImageHeight = $magazineImageHeight - 2*$this->getMagazinePadding();
			
			$content = str_replace("{magazinePadding}", $this->getMagazinePadding(), $content);
			
			$content = str_replace("{magazineImageWidth}", $magazineImageWidth, $content);
			$content = str_replace("{magazineImageHeight}", $magazineImageHeight, $content);
			
			$content = str_replace("{paddedMagazineImageWidth}", $paddedMagazineImageWidth, $content);
			$content = str_replace("{paddedMagazineImageHeight}", $paddedMagazineImageHeight, $content);
		}
		
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
     * @var \AppBundle\Entity\NewsletterPage
     */
    private $newsletterPage;

    /**
     * @var \AppBundle\Entity\NewsletterBlockTemplate
     */
    private $newsletterBlockTemplate;

    /**
     * Set newsletterPage
     *
     * @param \AppBundle\Entity\NewsletterPage $newsletterPage
     *
     * @return NewsletterBlock
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
     * Set newsletterBlockTemplate
     *
     * @param \AppBundle\Entity\NewsletterBlockTemplate $newsletterBlockTemplate
     *
     * @return NewsletterBlock
     */
    public function setNewsletterBlockTemplate(\AppBundle\Entity\NewsletterBlockTemplate $newsletterBlockTemplate = null)
    {
        $this->newsletterBlockTemplate = $newsletterBlockTemplate;

        return $this;
    }

    /**
     * Get newsletterBlockTemplate
     *
     * @return \AppBundle\Entity\NewsletterBlockTemplate
     */
    public function getNewsletterBlockTemplate()
    {
        return $this->newsletterBlockTemplate;
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
     * @return NewsletterBlock
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $newsletterBlockAdvertAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $newsletterBlockArticleAssignments;


    /**
     * Add newsletterBlockAdvertAssignment
     *
     * @param \AppBundle\Entity\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment
     *
     * @return NewsletterBlock
     */
    public function addNewsletterBlockAdvertAssignment(\AppBundle\Entity\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment)
    {
        $this->newsletterBlockAdvertAssignments[] = $newsletterBlockAdvertAssignment;

        return $this;
    }

    /**
     * Remove newsletterBlockAdvertAssignment
     *
     * @param \AppBundle\Entity\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment
     */
    public function removeNewsletterBlockAdvertAssignment(\AppBundle\Entity\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment)
    {
        $this->newsletterBlockAdvertAssignments->removeElement($newsletterBlockAdvertAssignment);
    }

    /**
     * Get newsletterBlockAdvertAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewsletterBlockAdvertAssignments()
    {
        return $this->newsletterBlockAdvertAssignments;
    }

    /**
     * Add newsletterBlockArticleAssignment
     *
     * @param \AppBundle\Entity\NewsletterBlockArticleAssignment $newsletterBlockArticleAssignment
     *
     * @return NewsletterBlock
     */
    public function addNewsletterBlockArticleAssignment(\AppBundle\Entity\NewsletterBlockArticleAssignment $newsletterBlockArticleAssignment)
    {
        $this->newsletterBlockArticleAssignments[] = $newsletterBlockArticleAssignment;

        return $this;
    }

    /**
     * Remove newsletterBlockArticleAssignment
     *
     * @param \AppBundle\Entity\NewsletterBlockArticleAssignment $newsletterBlockArticleAssignment
     */
    public function removeNewsletterBlockArticleAssignment(\AppBundle\Entity\NewsletterBlockArticleAssignment $newsletterBlockArticleAssignment)
    {
        $this->newsletterBlockArticleAssignments->removeElement($newsletterBlockArticleAssignment);
    }

    /**
     * Get newsletterBlockArticleAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewsletterBlockArticleAssignments()
    {
        return $this->newsletterBlockArticleAssignments;
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
     * @return NewsletterBlock
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
     * @var integer
     */
    private $xAdvertRatio;

    /**
     * @var integer
     */
    private $yAdvertRatio;

    /**
     * @var integer
     */
    private $xArticleRatio;

    /**
     * @var integer
     */
    private $yArticleRatio;

    /**
     * @var integer
     */
    private $xMagazineRatio;

    /**
     * @var integer
     */
    private $yMagazineRatio;


    /**
     * Set xAdvertRatio
     *
     * @param integer $xAdvertRatio
     *
     * @return NewsletterBlock
     */
    public function setXAdvertRatio($xAdvertRatio)
    {
        $this->xAdvertRatio = $xAdvertRatio;

        return $this;
    }

    /**
     * Get xAdvertRatio
     *
     * @return integer
     */
    public function getXAdvertRatio()
    {
        return $this->xAdvertRatio;
    }

    /**
     * Set yAdvertRatio
     *
     * @param integer $yAdvertRatio
     *
     * @return NewsletterBlock
     */
    public function setYAdvertRatio($yAdvertRatio)
    {
        $this->yAdvertRatio = $yAdvertRatio;

        return $this;
    }

    /**
     * Get yAdvertRatio
     *
     * @return integer
     */
    public function getYAdvertRatio()
    {
        return $this->yAdvertRatio;
    }

    /**
     * Set xArticleRatio
     *
     * @param integer $xArticleRatio
     *
     * @return NewsletterBlock
     */
    public function setXArticleRatio($xArticleRatio)
    {
        $this->xArticleRatio = $xArticleRatio;

        return $this;
    }

    /**
     * Get xArticleRatio
     *
     * @return integer
     */
    public function getXArticleRatio()
    {
        return $this->xArticleRatio;
    }

    /**
     * Set yArticleRatio
     *
     * @param integer $yArticleRatio
     *
     * @return NewsletterBlock
     */
    public function setYArticleRatio($yArticleRatio)
    {
        $this->yArticleRatio = $yArticleRatio;

        return $this;
    }

    /**
     * Get yArticleRatio
     *
     * @return integer
     */
    public function getYArticleRatio()
    {
        return $this->yArticleRatio;
    }

    /**
     * Set xMagazineRatio
     *
     * @param integer $xMagazineRatio
     *
     * @return NewsletterBlock
     */
    public function setXMagazineRatio($xMagazineRatio)
    {
        $this->xMagazineRatio = $xMagazineRatio;

        return $this;
    }

    /**
     * Get xMagazineRatio
     *
     * @return integer
     */
    public function getXMagazineRatio()
    {
        return $this->xMagazineRatio;
    }

    /**
     * Set yMagazineRatio
     *
     * @param integer $yMagazineRatio
     *
     * @return NewsletterBlock
     */
    public function setYMagazineRatio($yMagazineRatio)
    {
        $this->yMagazineRatio = $yMagazineRatio;

        return $this;
    }

    /**
     * Get yMagazineRatio
     *
     * @return integer
     */
    public function getYMagazineRatio()
    {
        return $this->yMagazineRatio;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $newsletterBlockMagazineAssignments;


    /**
     * Add newsletterBlockMagazineAssignment
     *
     * @param \AppBundle\Entity\NewsletterBlockMagazineAssignment $newsletterBlockMagazineAssignment
     *
     * @return NewsletterBlock
     */
    public function addNewsletterBlockMagazineAssignment(\AppBundle\Entity\NewsletterBlockMagazineAssignment $newsletterBlockMagazineAssignment)
    {
        $this->newsletterBlockMagazineAssignments[] = $newsletterBlockMagazineAssignment;

        return $this;
    }

    /**
     * Remove newsletterBlockMagazineAssignment
     *
     * @param \AppBundle\Entity\NewsletterBlockMagazineAssignment $newsletterBlockMagazineAssignment
     */
    public function removeNewsletterBlockMagazineAssignment(\AppBundle\Entity\NewsletterBlockMagazineAssignment $newsletterBlockMagazineAssignment)
    {
        $this->newsletterBlockMagazineAssignments->removeElement($newsletterBlockMagazineAssignment);
    }

    /**
     * Get newsletterBlockMagazineAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewsletterBlockMagazineAssignments()
    {
        return $this->newsletterBlockMagazineAssignments;
    }
    /**
     * @var integer
     */
    private $magazinePadding;


    /**
     * Set magazinePadding
     *
     * @param integer $magazinePadding
     *
     * @return NewsletterBlock
     */
    public function setMagazinePadding($magazinePadding)
    {
        $this->magazinePadding = $magazinePadding;

        return $this;
    }

    /**
     * Get magazinePadding
     *
     * @return integer
     */
    public function getMagazinePadding()
    {
        return $this->magazinePadding;
    }
}
