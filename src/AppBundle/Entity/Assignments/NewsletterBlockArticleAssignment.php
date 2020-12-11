<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;

class NewsletterBlockArticleAssignment extends Simple {

	public function getDisplayName() {
		return $this->article->getDisplayName();
	}

	/**
	 *
	 * @var integer
	 */
	private $orderNumber;

	/**
	 *
	 * @var string
	 */
	private $alternativeName;

	/**
	 *
	 * @var string
	 */
	private $alternativeSubname;

	/**
	 *
	 * @var string
	 */
	private $alternativeBrands;

	/**
	 *
	 * @var \AppBundle\Entity\Main\NewsletterBlock
	 */
	private $newsletterBlock;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Article
	 */
	private $article;

	/**
	 * Set orderNumber
	 *
	 * @param integer $orderNumber        	
	 *
	 * @return NewsletterBlockArticleAssignment
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
	 * Set alternativeName
	 *
	 * @param string $alternativeName        	
	 *
	 * @return NewsletterBlockArticleAssignment
	 */
	public function setAlternativeName($alternativeName) {
		$this->alternativeName = $alternativeName;
		
		return $this;
	}

	/**
	 * Get alternativeName
	 *
	 * @return string
	 */
	public function getAlternativeName() {
		return $this->alternativeName;
	}

	/**
	 * Set alternativeSubname
	 *
	 * @param string $alternativeSubname        	
	 *
	 * @return NewsletterBlockArticleAssignment
	 */
	public function setAlternativeSubname($alternativeSubname) {
		$this->alternativeSubname = $alternativeSubname;
		
		return $this;
	}

	/**
	 * Get alternativeSubname
	 *
	 * @return string
	 */
	public function getAlternativeSubname() {
		return $this->alternativeSubname;
	}

	/**
	 * Set alternativeBrands
	 *
	 * @param string $alternativeBrands        	
	 *
	 * @return NewsletterBlockArticleAssignment
	 */
	public function setAlternativeBrands($alternativeBrands) {
		$this->alternativeBrands = $alternativeBrands;
		
		return $this;
	}

	/**
	 * Get alternativeBrands
	 *
	 * @return string
	 */
	public function getAlternativeBrands() {
		return $this->alternativeBrands;
	}

	/**
	 * Set newsletterBlock
	 *
	 * @param \AppBundle\Entity\Main\NewsletterBlock $newsletterBlock        	
	 *
	 * @return NewsletterBlockArticleAssignment
	 */
	public function setNewsletterBlock(\AppBundle\Entity\Main\NewsletterBlock $newsletterBlock = null) {
		$this->newsletterBlock = $newsletterBlock;
		
		return $this;
	}

	/**
	 * Get newsletterBlock
	 *
	 * @return \AppBundle\Entity\Main\NewsletterBlock
	 */
	public function getNewsletterBlock() {
		return $this->newsletterBlock;
	}

	/**
	 * Set article
	 *
	 * @param \AppBundle\Entity\Main\Article $article        	
	 *
	 * @return NewsletterBlockArticleAssignment
	 */
	public function setArticle(\AppBundle\Entity\Main\Article $article = null) {
		$this->article = $article;
		
		return $this;
	}

	/**
	 * Get article
	 *
	 * @return \AppBundle\Entity\Main\Article
	 */
	public function getArticle() {
		return $this->article;
	}
}
