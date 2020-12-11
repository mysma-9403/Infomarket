<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Simple;

class NewsletterBlock extends Simple {

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
		
		foreach ($this->newsletterBlockArticleAssignments as $newsletterBlockArticleAssignment) {
			$article = $newsletterBlockArticleAssignment->getArticle();
			
			$entryContent = $this->newsletterBlockTemplate->getArticleContent();
			
			$name = $newsletterBlockArticleAssignment->getAlternativeName();
			$subname = $newsletterBlockArticleAssignment->getAlternativeSubname();
			
			if (! $name)
				$name = $article->getName();
			if (! $subname)
				$subname = $article->getSubname();
			
			$entryContent = str_replace("{articleId}", $article->getId(), $entryContent);
			$entryContent = str_replace("{articleName}", $name, $entryContent);
			$entryContent = str_replace("{articleSubname}", $subname, $entryContent);
			$entryContent = str_replace("{articleImage}", $article->getImage(), $entryContent);
			$entryContent = str_replace("{articleIntro}", $article->getIntro(), $entryContent);
			
			$brands = $newsletterBlockArticleAssignment->getAlternativeBrands();
			if (! $brands) {
				if ($article->getArticleBrandAssignments()) {
					$brands = '';
					foreach ($article->getArticleBrandAssignments() as $articleBrandAssignment) {
						if ($brands) {
							$brands .= ', ' . $articleBrandAssignment->getBrand()->getName();
						} else {
							$brands = $articleBrandAssignment->getBrand()->getName();
						}
					}
				}
			}
			$entryContent = str_replace("{articleBrands}", $brands, $entryContent);
			
			if ($article->getArticleCategoryAssignments()) {
				foreach ($article->getArticleCategoryAssignments() as $articleCategoryAssignment) {
					$entryContent = str_replace("{categoryId}", 
							$articleCategoryAssignment->getCategory()->getId(), $entryContent);
					break;
				}
			}
			
			if ($brands && strlen($brands) > 0) {
				$entryContent = str_replace("{articleSeparator}", $this->getArticleSeparator(), $entryContent);
			} else {
				$entryContent = str_replace("{articleSeparator}", '', $entryContent);
			}
			
			$articles .= $entryContent . "\r\n";
		}
		
		foreach ($this->newsletterBlockMagazineAssignments as $newsletterBlockMagazineAssignment) {
			$magazine = $newsletterBlockMagazineAssignment->getMagazine();
			
			$entryContent = $this->newsletterBlockTemplate->getMagazineContent();
			
			$name = $newsletterBlockMagazineAssignment->getAlternativeName();
			
			if (! $name)
				$name = $magazine->getName();
			
			$entryContent = str_replace("{magazineId}", $magazine->getId(), $entryContent);
			$entryContent = str_replace("{magazineName}", $name, $entryContent);
			$entryContent = str_replace("{magazineImage}", $magazine->getImage(), $entryContent);
			$entryContent = str_replace("{magazineSeparator}", $this->getMagazineSeparator(), $entryContent);
			
			$magazines .= $entryContent . "\r\n";
		}
		
		$content = str_replace("{adverts}", $adverts, $content);
		$content = str_replace("{articles}", $articles, $content);
		$content = str_replace("{magazines}", $magazines, $content);
		
		$content = str_replace("{blockName}", $this->getShowTitle() ? $this->name : '', $content);
		$content = str_replace("{blockSubname}", $this->getShowTitle() ? $this->subname : '', $content);
		
		if ($adverts != '') {
			$advertsCount = count($this->newsletterBlockAdvertAssignments);
			if ($advertsCount < 1)
				$advertsCount = 1;
			$advertImageWidth = 600 / $advertsCount - 10;
			$advertImageHeight = $advertImageWidth * $this->getYAdvertRatio() / $this->getXAdvertRatio();
			$content = str_replace("{advertImageWidth}", $advertImageWidth, $content);
			$content = str_replace("{advertImageHeight}", $advertImageHeight, $content);
		}
		
		if ($articles != '') {
			$articlesCount = count($this->newsletterBlockArticleAssignments);
			if ($articlesCount < 1)
				$articlesCount = 1;
			$articleImageWidth = 600 / $articlesCount - 10;
			$articleImageHeight = $articleImageWidth * $this->getYArticleRatio() / $this->getXArticleRatio();
			$content = str_replace("{articleImageWidth}", $articleImageWidth, $content);
			$content = str_replace("{articleImageHeight}", $articleImageHeight, $content);
		}
		
		if ($magazines != '') {
			$magazinesCount = count($this->newsletterBlockMagazineAssignments);
			if ($magazinesCount < 1)
				$magazinesCount = 1;
			
			$magazineImageWidth = 600 / $magazinesCount - 10;
			$magazineImageHeight = $magazineImageWidth * $this->getYMagazineRatio() / $this->getXMagazineRatio();
			
			$paddedMagazineImageWidth = $magazineImageWidth - 2 * $this->getMagazinePadding();
			$paddedMagazineImageHeight = $magazineImageHeight - 2 * $this->getMagazinePadding();
			
			$content = str_replace("{magazinePadding}", $this->getMagazinePadding(), $content);
			
			$content = str_replace("{magazineImageWidth}", $magazineImageWidth, $content);
			$content = str_replace("{magazineImageHeight}", $magazineImageHeight, $content);
			
			$content = str_replace("{paddedMagazineImageWidth}", $paddedMagazineImageWidth, $content);
			$content = str_replace("{paddedMagazineImageHeight}", $paddedMagazineImageHeight, $content);
		}
		
		return $content;
	}

	public function getDisplayName() {
		return $this->getName() . ' ' . $this->getSubname();
	}

	/**
	 *
	 * @var string
	 */
	private $name;

	/**
	 *
	 * @var string
	 */
	private $subname;

	/**
	 *
	 * @var boolean
	 */
	private $showTitle;

	/**
	 *
	 * @var integer
	 */
	private $orderNumber;

	/**
	 *
	 * @var integer
	 */
	private $xAdvertRatio;

	/**
	 *
	 * @var integer
	 */
	private $yAdvertRatio;

	/**
	 *
	 * @var integer
	 */
	private $xArticleRatio;

	/**
	 *
	 * @var integer
	 */
	private $yArticleRatio;

	/**
	 *
	 * @var integer
	 */
	private $xMagazineRatio;

	/**
	 *
	 * @var integer
	 */
	private $yMagazineRatio;

	/**
	 *
	 * @var integer
	 */
	private $magazinePadding;

	/**
	 *
	 * @var string
	 */
	private $articleSeparator;

	/**
	 *
	 * @var string
	 */
	private $magazineSeparator;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $newsletterBlockAdvertAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $newsletterBlockArticleAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $newsletterBlockMagazineAssignments;

	/**
	 *
	 * @var \AppBundle\Entity\Main\NewsletterPage
	 */
	private $newsletterPage;

	/**
	 *
	 * @var \AppBundle\Entity\Main\NewsletterBlockTemplate
	 */
	private $newsletterBlockTemplate;

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return NewsletterBlock
	 */
	public function setName($name) {
		$this->name = $name;
		
		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set subname
	 *
	 * @param string $subname        	
	 *
	 * @return NewsletterBlock
	 */
	public function setSubname($subname) {
		$this->subname = $subname;
		
		return $this;
	}

	/**
	 * Get subname
	 *
	 * @return string
	 */
	public function getSubname() {
		return $this->subname;
	}

	/**
	 * Set showTitle
	 *
	 * @param boolean $showTitle        	
	 *
	 * @return NewsletterBlock
	 */
	public function setShowTitle($showTitle) {
		$this->showTitle = $showTitle;
		
		return $this;
	}

	/**
	 * Get showTitle
	 *
	 * @return boolean
	 */
	public function getShowTitle() {
		return $this->showTitle;
	}

	/**
	 * Set orderNumber
	 *
	 * @param integer $orderNumber        	
	 *
	 * @return NewsletterBlock
	 */
	public function setOrderNumber($orderNumber) {
		$this->orderNumber = $orderNumber;
		
		return $this;
	}

	/**
	 * Get orderNumber
	 *
	 * @return integer
	 */
	public function getOrderNumber() {
		return $this->orderNumber;
	}

	/**
	 * Set xAdvertRatio
	 *
	 * @param integer $xAdvertRatio        	
	 *
	 * @return NewsletterBlock
	 */
	public function setXAdvertRatio($xAdvertRatio) {
		$this->xAdvertRatio = $xAdvertRatio;
		
		return $this;
	}

	/**
	 * Get xAdvertRatio
	 *
	 * @return integer
	 */
	public function getXAdvertRatio() {
		return $this->xAdvertRatio;
	}

	/**
	 * Set yAdvertRatio
	 *
	 * @param integer $yAdvertRatio        	
	 *
	 * @return NewsletterBlock
	 */
	public function setYAdvertRatio($yAdvertRatio) {
		$this->yAdvertRatio = $yAdvertRatio;
		
		return $this;
	}

	/**
	 * Get yAdvertRatio
	 *
	 * @return integer
	 */
	public function getYAdvertRatio() {
		return $this->yAdvertRatio;
	}

	/**
	 * Set xArticleRatio
	 *
	 * @param integer $xArticleRatio        	
	 *
	 * @return NewsletterBlock
	 */
	public function setXArticleRatio($xArticleRatio) {
		$this->xArticleRatio = $xArticleRatio;
		
		return $this;
	}

	/**
	 * Get xArticleRatio
	 *
	 * @return integer
	 */
	public function getXArticleRatio() {
		return $this->xArticleRatio;
	}

	/**
	 * Set yArticleRatio
	 *
	 * @param integer $yArticleRatio        	
	 *
	 * @return NewsletterBlock
	 */
	public function setYArticleRatio($yArticleRatio) {
		$this->yArticleRatio = $yArticleRatio;
		
		return $this;
	}

	/**
	 * Get yArticleRatio
	 *
	 * @return integer
	 */
	public function getYArticleRatio() {
		return $this->yArticleRatio;
	}

	/**
	 * Set xMagazineRatio
	 *
	 * @param integer $xMagazineRatio        	
	 *
	 * @return NewsletterBlock
	 */
	public function setXMagazineRatio($xMagazineRatio) {
		$this->xMagazineRatio = $xMagazineRatio;
		
		return $this;
	}

	/**
	 * Get xMagazineRatio
	 *
	 * @return integer
	 */
	public function getXMagazineRatio() {
		return $this->xMagazineRatio;
	}

	/**
	 * Set yMagazineRatio
	 *
	 * @param integer $yMagazineRatio        	
	 *
	 * @return NewsletterBlock
	 */
	public function setYMagazineRatio($yMagazineRatio) {
		$this->yMagazineRatio = $yMagazineRatio;
		
		return $this;
	}

	/**
	 * Get yMagazineRatio
	 *
	 * @return integer
	 */
	public function getYMagazineRatio() {
		return $this->yMagazineRatio;
	}

	/**
	 * Set magazinePadding
	 *
	 * @param integer $magazinePadding        	
	 *
	 * @return NewsletterBlock
	 */
	public function setMagazinePadding($magazinePadding) {
		$this->magazinePadding = $magazinePadding;
		
		return $this;
	}

	/**
	 * Get magazinePadding
	 *
	 * @return integer
	 */
	public function getMagazinePadding() {
		return $this->magazinePadding;
	}

	/**
	 * Set articleSeparator
	 *
	 * @param string $articleSeparator        	
	 *
	 * @return NewsletterBlock
	 */
	public function setArticleSeparator($articleSeparator) {
		$this->articleSeparator = $articleSeparator;
		
		return $this;
	}

	/**
	 * Get articleSeparator
	 *
	 * @return string
	 */
	public function getArticleSeparator() {
		return $this->articleSeparator;
	}

	/**
	 * Set magazineSeparator
	 *
	 * @param string $magazineSeparator        	
	 *
	 * @return NewsletterBlock
	 */
	public function setMagazineSeparator($magazineSeparator) {
		$this->magazineSeparator = $magazineSeparator;
		
		return $this;
	}

	/**
	 * Get magazineSeparator
	 *
	 * @return string
	 */
	public function getMagazineSeparator() {
		return $this->magazineSeparator;
	}

	/**
	 * Add newsletterBlockAdvertAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment        	
	 *
	 * @return NewsletterBlock
	 */
	public function addNewsletterBlockAdvertAssignment(
			\AppBundle\Entity\Assignments\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment) {
		$this->newsletterBlockAdvertAssignments[] = $newsletterBlockAdvertAssignment;
		
		return $this;
	}

	/**
	 * Remove newsletterBlockAdvertAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment        	
	 */
	public function removeNewsletterBlockAdvertAssignment(
			\AppBundle\Entity\Assignments\NewsletterBlockAdvertAssignment $newsletterBlockAdvertAssignment) {
		$this->newsletterBlockAdvertAssignments->removeElement($newsletterBlockAdvertAssignment);
	}

	/**
	 * Get newsletterBlockAdvertAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getNewsletterBlockAdvertAssignments() {
		return $this->newsletterBlockAdvertAssignments;
	}

	/**
	 * Add newsletterBlockArticleAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterBlockArticleAssignment $newsletterBlockArticleAssignment        	
	 *
	 * @return NewsletterBlock
	 */
	public function addNewsletterBlockArticleAssignment(
			\AppBundle\Entity\Assignments\NewsletterBlockArticleAssignment $newsletterBlockArticleAssignment) {
		$this->newsletterBlockArticleAssignments[] = $newsletterBlockArticleAssignment;
		
		return $this;
	}

	/**
	 * Remove newsletterBlockArticleAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterBlockArticleAssignment $newsletterBlockArticleAssignment        	
	 */
	public function removeNewsletterBlockArticleAssignment(
			\AppBundle\Entity\Assignments\NewsletterBlockArticleAssignment $newsletterBlockArticleAssignment) {
		$this->newsletterBlockArticleAssignments->removeElement($newsletterBlockArticleAssignment);
	}

	/**
	 * Get newsletterBlockArticleAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getNewsletterBlockArticleAssignments() {
		return $this->newsletterBlockArticleAssignments;
	}

	/**
	 * Add newsletterBlockMagazineAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterBlockMagazineAssignment $newsletterBlockMagazineAssignment        	
	 *
	 * @return NewsletterBlock
	 */
	public function addNewsletterBlockMagazineAssignment(
			\AppBundle\Entity\Assignments\NewsletterBlockMagazineAssignment $newsletterBlockMagazineAssignment) {
		$this->newsletterBlockMagazineAssignments[] = $newsletterBlockMagazineAssignment;
		
		return $this;
	}

	/**
	 * Remove newsletterBlockMagazineAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\NewsletterBlockMagazineAssignment $newsletterBlockMagazineAssignment        	
	 */
	public function removeNewsletterBlockMagazineAssignment(
			\AppBundle\Entity\Assignments\NewsletterBlockMagazineAssignment $newsletterBlockMagazineAssignment) {
		$this->newsletterBlockMagazineAssignments->removeElement($newsletterBlockMagazineAssignment);
	}

	/**
	 * Get newsletterBlockMagazineAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getNewsletterBlockMagazineAssignments() {
		return $this->newsletterBlockMagazineAssignments;
	}

	/**
	 * Set newsletterPage
	 *
	 * @param \AppBundle\Entity\Main\NewsletterPage $newsletterPage        	
	 *
	 * @return NewsletterBlock
	 */
	public function setNewsletterPage(\AppBundle\Entity\Main\NewsletterPage $newsletterPage = null) {
		$this->newsletterPage = $newsletterPage;
		
		return $this;
	}

	/**
	 * Get newsletterPage
	 *
	 * @return \AppBundle\Entity\Main\NewsletterPage
	 */
	public function getNewsletterPage() {
		return $this->newsletterPage;
	}

	/**
	 * Set newsletterBlockTemplate
	 *
	 * @param \AppBundle\Entity\Main\NewsletterBlockTemplate $newsletterBlockTemplate        	
	 *
	 * @return NewsletterBlock
	 */
	public function setNewsletterBlockTemplate(
			\AppBundle\Entity\Main\NewsletterBlockTemplate $newsletterBlockTemplate = null) {
		$this->newsletterBlockTemplate = $newsletterBlockTemplate;
		
		return $this;
	}

	/**
	 * Get newsletterBlockTemplate
	 *
	 * @return \AppBundle\Entity\Main\NewsletterBlockTemplate
	 */
	public function getNewsletterBlockTemplate() {
		return $this->newsletterBlockTemplate;
	}
}
