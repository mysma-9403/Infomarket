<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\SimpleEntityController;
use AppBundle\Entity\Filter\MagazineFilter;
use AppBundle\Entity\Magazine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class MagazineController extends SimpleEntityController
{   
	/**
	 * 
	 * @param Request $request
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getEntityType()
	 */
    protected function getEntityType()
    {
    	return Magazine::class;
    }
    
    protected function createNewFilter()	
    {
    	$userRepository = $this->getDoctrine()->getRepository(User::class);
    	return new MagazineFilter($userRepository);
    }
}
