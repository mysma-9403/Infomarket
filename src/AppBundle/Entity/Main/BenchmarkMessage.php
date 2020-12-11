<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Simple;

class BenchmarkMessage extends Simple {

	const REPORTED_STATE = 0;

	const IN_PROCESS_STATE = 10;

	const INFORMATION_REQUIRED_STATE = 20;

	const INFORMATION_SUPPLIED_STATE = 21;

	const COMPLETED_STATE = 30;

	/**
	 *
	 * @var string
	 */
	private $name;

	/**
	 *
	 * @var integer
	 */
	private $state;

	/**
	 *
	 * @var string
	 */
	private $content;

	/**
	 *
	 * @var boolean
	 */
	private $readByAuthor;

	/**
	 *
	 * @var boolean
	 */
	private $readByAdmin;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $children;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Product
	 */
	private $product;

	/**
	 *
	 * @var \AppBundle\Entity\Main\User
	 */
	private $author;

	/**
	 *
	 * @var \AppBundle\Entity\Main\BenchmarkMessage
	 */
	private $parent;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->children = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return BenchmarkMessage
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
	 * Set state
	 *
	 * @param integer $state        	
	 *
	 * @return BenchmarkMessage
	 */
	public function setState($state) {
		$this->state = $state;
		
		return $this;
	}

	/**
	 * Get state
	 *
	 * @return integer
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * Set content
	 *
	 * @param string $content        	
	 *
	 * @return BenchmarkMessage
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
	 * Set readByAuthor
	 *
	 * @param boolean $readByAuthor        	
	 *
	 * @return BenchmarkMessage
	 */
	public function setReadByAuthor($readByAuthor) {
		$this->readByAuthor = $readByAuthor;
		
		return $this;
	}

	/**
	 * Get readByAuthor
	 *
	 * @return boolean
	 */
	public function getReadByAuthor() {
		return $this->readByAuthor;
	}

	/**
	 * Set readByAdmin
	 *
	 * @param boolean $readByAdmin        	
	 *
	 * @return BenchmarkMessage
	 */
	public function setReadByAdmin($readByAdmin) {
		$this->readByAdmin = $readByAdmin;
		
		return $this;
	}

	/**
	 * Get readByAdmin
	 *
	 * @return boolean
	 */
	public function getReadByAdmin() {
		return $this->readByAdmin;
	}

	/**
	 * Add child
	 *
	 * @param \AppBundle\Entity\Main\BenchmarkMessage $child        	
	 *
	 * @return BenchmarkMessage
	 */
	public function addChild(\AppBundle\Entity\Main\BenchmarkMessage $child) {
		$this->children[] = $child;
		
		return $this;
	}

	/**
	 * Remove child
	 *
	 * @param \AppBundle\Entity\Main\BenchmarkMessage $child        	
	 */
	public function removeChild(\AppBundle\Entity\Main\BenchmarkMessage $child) {
		$this->children->removeElement($child);
	}

	/**
	 * Get children
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getChildren() {
		return $this->children;
	}

	/**
	 * Set product
	 *
	 * @param \AppBundle\Entity\Main\Product $product        	
	 *
	 * @return BenchmarkMessage
	 */
	public function setProduct(\AppBundle\Entity\Main\Product $product = null) {
		$this->product = $product;
		
		return $this;
	}

	/**
	 * Get product
	 *
	 * @return \AppBundle\Entity\Main\Product
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * Set author
	 *
	 * @param \AppBundle\Entity\Main\User $author        	
	 *
	 * @return BenchmarkMessage
	 */
	public function setAuthor(\AppBundle\Entity\Main\User $author = null) {
		$this->author = $author;
		
		return $this;
	}

	/**
	 * Get author
	 *
	 * @return \AppBundle\Entity\Main\User
	 */
	public function getAuthor() {
		return $this->author;
	}

	/**
	 * Set parent
	 *
	 * @param \AppBundle\Entity\Main\BenchmarkMessage $parent        	
	 *
	 * @return BenchmarkMessage
	 */
	public function setParent(\AppBundle\Entity\Main\BenchmarkMessage $parent = null) {
		$this->parent = $parent;
		
		return $this;
	}

	/**
	 * Get parent
	 *
	 * @return \AppBundle\Entity\Main\BenchmarkMessage
	 */
	public function getParent() {
		return $this->parent;
	}
}
