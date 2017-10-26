<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Simple;

class BenchmarkEnum extends Simple {
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $value;

    /**
     * @var \AppBundle\Entity\Main\Category
     */
    private $category;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return BenchmarkEnum
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
     * Set value
     *
     * @param integer $value
     *
     * @return BenchmarkEnum
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Main\Category $category
     *
     * @return BenchmarkEnum
     */
    public function setCategory(\AppBundle\Entity\Main\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Main\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
