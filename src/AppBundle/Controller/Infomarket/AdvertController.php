<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Base\BaseController;
use AppBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdvertController extends BaseController
{   
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	public function clickAction(Request $request, $id)
	{
		return $this->clickActionInternal($request, $id);
	}

	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	protected function clickActionInternal(Request $request, $id)
	{
		$am = $this->getAnalyticsManager();
		$am->sendEventAnalytics($this->getEntityName(), 'click', $id);
		
		$entry = $this->getEntry($id);
		$entry->setClickCount($entry->getClickCount()+1);
		
		$this->saveEntry($entry);
		
		return $this->redirect($request->getScheme() . '://' . $entry->getLink());
	}
	
	protected function saveEntry($entry) {
		$em = $this->getDoctrine()->getManager();
			
		$em->persist($entry);
		$em->flush();
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
    
    protected function getEntityType()
    {
    	return Advert::class;
    }
    
    //-----------------------------------------------------------------
    // Domain
    //---------------------------------------------------------------------------
    
    /**
     * @return string domain - base part of the route
     */
    protected function getDomain() 
    {
    	return 'infomarket';
    }
}
