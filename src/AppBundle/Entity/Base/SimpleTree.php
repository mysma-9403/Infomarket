<?php

namespace AppBundle\Entity\Base;

class SimpleTree extends Audit
{
   
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
     * @var \AppBundle\Entity\Base\SimpleTree
     */
    private $parent;


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

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\Base\SimpleTree $parent
     *
     * @return SimpleTree
     */
    public function setParent(\AppBundle\Entity\Base\SimpleTree $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Base\SimpleTree
     */
    public function getParent()
    {
        return $this->parent;
    }
}
