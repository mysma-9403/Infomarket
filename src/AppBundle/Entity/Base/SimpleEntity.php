<?php

namespace AppBundle\Entity\Base;

class SimpleEntity extends Audit
{
	public function __toString() {
		return $this->name;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->name;
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
