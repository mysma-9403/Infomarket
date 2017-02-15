<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Base\DummyController;
use AppBundle\Entity\Link;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LinkController extends DummyController
{   
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}

	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	protected function showActionInternal(Request $request, $id)
	{
		$am = $this->getAnalyticsManager();
		$am->sendEventAnalytics($this->getEntityName(), 'show', $id);
		
		/** @var Link $entry */
		$entry = $this->getEntry($id);
		
		$scheme = $request->getScheme() . '://';
		
		$link = $entry->getUrl();
		$link = str_replace('http://', '', $link);
		$link = str_replace('https://', '', $link);
		
		return $this->redirect($scheme . $link);
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
    
    protected function getEntityType()
    {
    	return Link::class;
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
