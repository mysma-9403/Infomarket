<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{
	const ROLE_EDITOR = 'ROLE_EDITOR';
	const ROLE_PUBLISHER = 'ROLE_PUBLISHER';
	const ROLE_ADMIN = 'ROLE_ADMIN';
}
