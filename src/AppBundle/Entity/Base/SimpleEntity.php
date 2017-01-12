<?php

namespace AppBundle\Entity\Base;

class SimpleEntity extends Simple
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		$result = '<empty>';
		if($this->name) $result = $this->name;
		return $result;
	}
	
    /**
     * @var string
     */
    protected $name;


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
}
