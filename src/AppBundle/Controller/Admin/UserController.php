<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\User;

class UserController extends Controller
{
	public function showAction(User $entry)
	{
		return $this->render('admin/user/show.html.twig', array('entry' => $entry));
	}
}