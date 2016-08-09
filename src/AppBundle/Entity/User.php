<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{
	const ROLE_EDITOR = 'ROLE_EDITOR';
	const ROLE_PUBLISHER = 'ROLE_PUBLISHER';
	const ROLE_ADMIN = 'ROLE_ADMIN';
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
}
