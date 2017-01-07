<?php

namespace AppBundle\Entity\Base;

/**
 * ImageEntityTree
 */
class ImageEntityTree extends Image
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		$name = '<empty>';
		
		if($this->name) $name = $this->name;
	
		$parent = $this->getParent();
		if($parent) {
			$name .= ' / ';
			$name .= $parent->getDisplayName();
		}
	
		return $name;
	}
	
	public function getParentChain() {
		$chain = array();
	
		$parent = $this->getParent();
		while($parent) {
			array_unshift($chain, $parent);
			$parent = $parent->getParent();
		}
	
		return $chain;
	}
	
	
    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $level;

    /**
     * @var string
     */
    protected $treePath;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return ImageEntityTree
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return ImageEntityTree
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set treePath
     *
     * @param string $treePath
     *
     * @return ImageEntityTree
     */
    public function setTreePath($treePath)
    {
        $this->treePath = $treePath;

        return $this;
    }

    /**
     * Get treePath
     *
     * @return string
     */
    public function getTreePath()
    {
        return $this->treePath;
    }
}
