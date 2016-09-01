<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntity;

class NewsletterBlock extends SimpleEntity
{
	public function getNewsletterCode() {
		$content = $this->newsletterBlockTemplate->getContent();
	
		if($this->article) {
			$content = str_replace("{articleId}", $this->article->getId(), $content);
			$content = str_replace("{articleName}", $this->article->getName(), $content);
			$content = str_replace("{articleSubname}", $this->article->getSubname(), $content);
			$content = str_replace("{articleImage}", $this->article->getImagePath(), $content);
			$content = str_replace("{articleIntro}", $this->article->getIntro(), $content);
			
			if($this->article->getArticleBrandAssignments()) {
				$brands = '';
				foreach($this->article->getArticleBrandAssignments() as $articleBrandAssignment) {
					if($brands) {
						$brands .= ', ' . $articleBrandAssignment->getBrand()->getName();
					} else {
						$brands = $articleBrandAssignment->getBrand()->getName();
					}
				}
				$content = str_replace("{articleBrands}", $brands, $content);
			}
			
			if($this->article->getArticleCategoryAssignments()) {
				foreach($this->article->getArticleCategoryAssignments() as $articleCategoryAssignment) {
					$content = str_replace("{categoryId}", $articleCategoryAssignment->getCategory()->getId(), $content);
					break;
				}
			}
		}
		
		if($this->advert) {
			$content = str_replace("{advertId}", $this->advert->getId(), $content);
			$content = str_replace("{advertName}", $this->advert->getName(), $content);
			$content = str_replace("{advertImage}", $this->advert->getImagePath(), $content);
		}
	
		return $content;
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
     * @var \AppBundle\Entity\Advert
     */
    private $advert;

    /**
     * @var \AppBundle\Entity\Article
     */
    private $article;


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
     * Set advert
     *
     * @param \AppBundle\Entity\Advert $advert
     *
     * @return NewsletterBlock
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
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return NewsletterBlock
     */
    public function setArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \AppBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
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
}
