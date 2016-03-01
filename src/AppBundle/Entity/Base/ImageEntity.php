<?php

namespace AppBundle\Entity\Base;

class ImageEntity extends Image
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
     * @return ImageEntity
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
