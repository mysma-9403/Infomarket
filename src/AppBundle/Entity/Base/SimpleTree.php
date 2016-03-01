<?php

namespace AppBundle\Entity\Base;

class SimpleTree extends Audit
{
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
     * @var integer
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\Base\SimpleTree
     */
    protected $parent;


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

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
