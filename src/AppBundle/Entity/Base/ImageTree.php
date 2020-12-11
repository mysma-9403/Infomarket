<?php

namespace AppBundle\Entity\Base;

class ImageTree extends Image {

	public function getDisplayName() {
		$name = $this->name;
		
		$parent = $this->getParent();
		if ($parent) {
			$name .= ' / ';
			$name .= $parent->getDisplayName();
		}
		
		return $name;
	}

	public function getParentChain() {
		$chain = array();
		
		$parent = $this->getParent();
		while ($parent) {
			array_unshift($chain, $parent);
			$parent = $parent->getParent();
		}
		
		return $chain;
	}

	/**
	 *
	 * @var string
	 */
	protected $name;

	/**
	 *
	 * @var integer
	 */
	protected $level;

	/**
	 *
	 * @var string
	 */
	protected $treePath;

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return ImageTree
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
	 * Set level
	 *
	 * @param integer $level        	
	 *
	 * @return ImageTree
	 */
	public function setLevel($level) {
		$this->level = $level;
		
		return $this;
	}

	/**
	 * Get level
	 *
	 * @return integer
	 */
	public function getLevel() {
		return $this->level;
	}

	/**
	 * Set treePath
	 *
	 * @param string $treePath        	
	 *
	 * @return ImageTree
	 */
	public function setTreePath($treePath) {
		$this->treePath = $treePath;
		
		return $this;
	}

	/**
	 * Get treePath
	 *
	 * @return string
	 */
	public function getTreePath() {
		return $this->treePath;
	}
}
