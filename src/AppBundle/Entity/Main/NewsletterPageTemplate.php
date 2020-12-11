<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Simple;

class NewsletterPageTemplate extends Simple {

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
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return NewsletterPageTemplate
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
	 * @return NewsletterPageTemplate
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
	 * @return NewsletterPageTemplate
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
}
