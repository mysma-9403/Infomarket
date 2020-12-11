<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Simple;

class NewsletterBlockTemplate extends Simple {

	public function getDisplayName() {
		return $this->getName();
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
	private $style;

	/**
	 *
	 * @var string
	 */
	private $content;

	/**
	 *
	 * @var string
	 */
	private $advertContent;

	/**
	 *
	 * @var string
	 */
	private $articleContent;

	/**
	 *
	 * @var string
	 */
	private $magazineContent;

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return NewsletterBlockTemplate
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
	 * Set style
	 *
	 * @param string $style        	
	 *
	 * @return NewsletterBlockTemplate
	 */
	public function setStyle($style) {
		$this->style = $style;
		
		return $this;
	}

	/**
	 * Get style
	 *
	 * @return string
	 */
	public function getStyle() {
		return $this->style;
	}

	/**
	 * Set content
	 *
	 * @param string $content        	
	 *
	 * @return NewsletterBlockTemplate
	 */
	public function setContent($content) {
		$this->content = $content;
		
		return $this;
	}

	/**
	 * Get content
	 *
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Set advertContent
	 *
	 * @param string $advertContent        	
	 *
	 * @return NewsletterBlockTemplate
	 */
	public function setAdvertContent($advertContent) {
		$this->advertContent = $advertContent;
		
		return $this;
	}

	/**
	 * Get advertContent
	 *
	 * @return string
	 */
	public function getAdvertContent() {
		return $this->advertContent;
	}

	/**
	 * Set articleContent
	 *
	 * @param string $articleContent        	
	 *
	 * @return NewsletterBlockTemplate
	 */
	public function setArticleContent($articleContent) {
		$this->articleContent = $articleContent;
		
		return $this;
	}

	/**
	 * Get articleContent
	 *
	 * @return string
	 */
	public function getArticleContent() {
		return $this->articleContent;
	}

	/**
	 * Set magazineContent
	 *
	 * @param string $magazineContent        	
	 *
	 * @return NewsletterBlockTemplate
	 */
	public function setMagazineContent($magazineContent) {
		$this->magazineContent = $magazineContent;
		
		return $this;
	}

	/**
	 * Get magazineContent
	 *
	 * @return string
	 */
	public function getMagazineContent() {
		return $this->magazineContent;
	}
}
