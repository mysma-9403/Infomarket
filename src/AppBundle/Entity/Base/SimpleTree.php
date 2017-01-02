<?php

namespace AppBundle\Entity\Base;

class SimpleTree extends Audit
{
	public function __toString() {
		return $this->name;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\SimpleEntity::getDisplayName()
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
	 * Get name enriched with the <br> sign after first word
	 *
	 * @return string
	 */
	public function getHtmlName()
	{
		$result = $this->getDisplayName();
		$pos = strpos($result, " ");
		if ($pos !== false) {
			$result = substr_replace($result, "<br>", $pos, 1);
		}
		return $result;
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
     * @return SimpleTree
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
     * @return SimpleTree
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
     * @return SimpleTree
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
