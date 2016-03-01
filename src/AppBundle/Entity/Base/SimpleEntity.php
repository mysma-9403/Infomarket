<?php

namespace AppBundle\Entity\Base;

class SimpleEntity extends Audit
{
	
    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $id;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return SimpleEntity
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
     * Set id
     *
     * @param integer $id
     *
     * @return SimpleEntity
     */
    public function setId($id)
    {
    	$this->id = $id;
    
    	return $this;
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
}
