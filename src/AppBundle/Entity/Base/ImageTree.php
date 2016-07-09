<?php

namespace AppBundle\Entity\Base;

class ImageTree extends Image
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Image::getDisplayName()
	 */
	public function getDisplayName() {
		$name = $this->name;
		
		$parent = $this->getParent();
		if($parent) {
			$name .= ' (';
			$name .= $parent->getName();
		
			$parent = $parent->getParent();
			while($parent) {
				$name .= '/';
				$name .= $parent->getName();
				$parent = $parent->getParent();
			}
			$name .= ')';
		}
	
		return $name;
	}
	
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $level;

    /**
     * @var string
     */
    private $treePath;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ImageTree
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
     * Get name enriched with the <br> sign after first word
     *
     * @return string
     */
    public function getHtmlName()
    {
    	$result = $this->name;
    	$pos = strpos($result, " ");
    	if ($pos !== false) {
    		$result = substr_replace($result, "<br>", $pos, 1);
    	}
    	return $result;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return ImageTree
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
     * @return ImageTree
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
