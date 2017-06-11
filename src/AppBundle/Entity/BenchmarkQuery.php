<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * BenchmarkQuery
 */
class BenchmarkQuery extends Audit
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->products = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
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

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $products;

    /**
     * Add product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return BenchmarkQuery
     */
    public function addProduct(\AppBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \AppBundle\Entity\Product $product
     */
    public function removeProduct(\AppBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
    /**
     * @var boolean
     */
    private $archived;


    /**
     * Set archived
     *
     * @param boolean $archived
     *
     * @return BenchmarkQuery
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * Get archived
     *
     * @return boolean
     */
    public function getArchived()
    {
        return $this->archived;
    }
}
