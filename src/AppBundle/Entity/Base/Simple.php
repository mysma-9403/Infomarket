<?php

namespace AppBundle\Entity\Base;

class Simple {

	public function getDisplayName() {
		return $this->id;
	}

	public function __toString() {
		return $this->getDisplayName();
	}

	public function __construct() {
	}
	
	public function clear() {
		$this->id = null;
		
		$this->setCreatedAt(null);
		$this->setCreatedBy(null);
		$this->setUpdatedAt(null);
		$this->setUpdatedBy(null);
	}

	/**
	 *
	 * @var \DateTime
	 */
	protected $createdAt;

	/**
	 *
	 * @var \DateTime
	 */
	protected $updatedAt;

	/**
	 *
	 * @var integer
	 */
	protected $id;

	/**
	 *
	 * @var \AppBundle\Entity\Main\User
	 */
	protected $createdBy;

	/**
	 *
	 * @var \AppBundle\Entity\Main\User
	 */
	protected $updatedBy;

	/**
	 * Set createdAt
	 *
	 * @param \DateTime $createdAt        	
	 *
	 * @return Simple
	 */
	public function setCreatedAt($createdAt) {
		$this->createdAt = $createdAt;
		
		return $this;
	}

	/**
	 * Get createdAt
	 *
	 * @return \DateTime
	 */
	public function getCreatedAt() {
		return $this->createdAt;
	}

	/**
	 * Set updatedAt
	 *
	 * @param \DateTime $updatedAt        	
	 *
	 * @return Simple
	 */
	public function setUpdatedAt($updatedAt) {
		$this->updatedAt = $updatedAt;
		
		return $this;
	}

	/**
	 * Get updatedAt
	 *
	 * @return \DateTime
	 */
	public function getUpdatedAt() {
		return $this->updatedAt;
	}

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set createdBy
	 *
	 * @param \AppBundle\Entity\Main\User $createdBy        	
	 *
	 * @return Simple
	 */
	public function setCreatedBy(\AppBundle\Entity\Main\User $createdBy = null) {
		$this->createdBy = $createdBy;
		
		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return \AppBundle\Entity\Main\User
	 */
	public function getCreatedBy() {
		return $this->createdBy;
	}

	/**
	 * Set updatedBy
	 *
	 * @param \AppBundle\Entity\Main\User $updatedBy        	
	 *
	 * @return Simple
	 */
	public function setUpdatedBy(\AppBundle\Entity\Main\User $updatedBy = null) {
		$this->updatedBy = $updatedBy;
		
		return $this;
	}

	/**
	 * Get updatedBy
	 *
	 * @return \AppBundle\Entity\Main\User
	 */
	public function getUpdatedBy() {
		return $this->updatedBy;
	}
}
