<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * BenchmarkEnum
 */
class BenchmarkEnum extends Audit
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $value;


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
}
