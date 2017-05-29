<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * BenchmarkQuery
 */
class BenchmarkQuery extends Audit
{
	public function getDisplayName() {
		return $this->getName();
	}
	
	/**
	 * @var string
	 */
	private $name;
	
	
	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return BenchmarkQuery
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
     * @var string
     */
    private $content;


    /**
     * Set content
     *
     * @param string $content
     *
     * @return BenchmarkQuery
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
