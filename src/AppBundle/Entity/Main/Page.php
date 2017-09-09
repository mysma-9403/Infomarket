<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Image;

class Page extends Image {

	public function getDisplayName() {
		$result = parent::getDisplayName();
		if ($this->subname) {
			if ($result == '<empty>')
				$result = $this->subname;
			else
				$result .= ' ' . $this->subname;
		}
		
		return $result;
	}

	public function getUploadPath() {
		return 'uploads/pages';
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
	 * @var boolean
	 */
	private $infomarket;

	/**
	 *
	 * @var boolean
	 */
	private $infoprodukt;

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
	 * @return Page
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
	 * @return Page
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
	 * @return Page
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
	 * Set infomarket
	 *
	 * @param boolean $infomarket        	
	 *
	 * @return Page
	 */
	public function setInfomarket($infomarket) {
		$this->infomarket = $infomarket;
		
		return $this;
	}

	/**
	 * Get infomarket
	 *
	 * @return boolean
	 */
	public function getInfomarket() {
		return $this->infomarket;
	}

	/**
	 * Set infoprodukt
	 *
	 * @param boolean $infoprodukt        	
	 *
	 * @return Page
	 */
	public function setInfoprodukt($infoprodukt) {
		$this->infoprodukt = $infoprodukt;
		
		return $this;
	}

	/**
	 * Get infoprodukt
	 *
	 * @return boolean
	 */
	public function getInfoprodukt() {
		return $this->infoprodukt;
	}

	/**
	 * Set content
	 *
	 * @param string $content        	
	 *
	 * @return Page
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
