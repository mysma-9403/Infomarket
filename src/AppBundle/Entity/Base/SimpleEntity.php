<?php

namespace AppBundle\Entity\Base;

class SimpleEntity extends Audit
{
	
    /**
     * @var string
     */
    private $name;


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
}
