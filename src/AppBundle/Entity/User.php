<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{
	const ROLE_EDITOR = 'ROLE_EDITOR';
	const ROLE_PUBLISHER = 'ROLE_PUBLISHER';
	const ROLE_ADMIN = 'ROLE_ADMIN';
    
	public function __toString() {
		return $this->getDisplayName();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		if($this->pseudonym != null) {
			return $this->pseudonym;
		}
		if($this->surname != null) {
		 	return $this->surname . ' ' . $this->forename;
		}
		return $this->username;
	}
	
    /**
     * @var string
     */
    private $forename;

    /**
     * @var string
     */
    private $surname;


    /**
     * Set forename
     *
     * @param string $forename
     *
     * @return User
     */
    public function setForename($forename)
    {
        $this->forename = $forename;

        return $this;
    }

    /**
     * Get forename
     *
     * @return string
     */
    public function getForename()
    {
        return $this->forename;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }
    /**
     * @var string
     */
    private $pseudonym;


    /**
     * Set pseudonym
     *
     * @param string $pseudonym
     *
     * @return User
     */
    public function setPseudonym($pseudonym)
    {
        $this->pseudonym = $pseudonym;

        return $this;
    }

    /**
     * Get pseudonym
     *
     * @return string
     */
    public function getPseudonym()
    {
        return $this->pseudonym;
    }
}
