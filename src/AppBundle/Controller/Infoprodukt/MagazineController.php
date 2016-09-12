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
	 * @param Request $request
	 * @param integer $id
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infoprodukt\Base\InfoproduktEntityController::showActionInternal()
	 */
	protected function showActionInternal(Request $request, $id)
	{
		$this->sendShowEventAnalytics($request, $id);
		
		$entry = $this->getEntry($id);
		
		$baseUrl = $request->getScheme() . '://' . $request->getHttpHost();
		$fileUrl = $entry->getMagazineFile();
		
		return $this->redirect($baseUrl . $fileUrl);
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
